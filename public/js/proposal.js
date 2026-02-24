$(document).ready(function () {
    const csrfToken = $('input[name="_token"]').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    var isLocalhost = window.location.hostname === "localhost" || window.location.hostname === "127.0.0.1";
    var path = window.location.pathname.split('/')[1] || '';
    var baseurl = isLocalhost
        ? window.location.protocol + "//" + window.location.host + (path ? "/" + path : "")
        : window.location.origin;

    console.log('baseurl', baseurl);
    let pageCount = 1;
    let layoutIdCounter = 0;
    let elementIdCounter = 0;

    let themetype = '';
    // Global variables
    let textEditor = null;
    let toggleDropdown = () => { };

    // Register custom size styles (once, outside initializeEditor)
    const Size = Quill.import('attributors/style/size');
    Size.whitelist = ['10px', '12px', '14px', '16px', '18px', '20px', '22px', '24px', '36px', '48px', '60px'];
    Quill.register(Size, true);

    // Register custom VariableBlot (once, outside initializeEditor)
    const Inline = Quill.import('blots/inline');
    class VariableBlot extends Inline {
        static create(value) {
            const node = super.create();
            console.log('Creating VariableBlot with value:', value);
            node.setAttribute('data-variable', value);
            node.textContent = value;
            node.classList.add('ql-variable-token');

            // Make it non-editable to prevent duplication
            node.setAttribute('contenteditable', 'false');

            return node;
        }

        static formats(node) {
            return node.getAttribute('data-variable');
        }

        // Prevent splitting of variable tokens
        static split(node, offset, force) {
            // Always return the whole node to prevent splitting
            return node;
        }

        // Override optimization to prevent merging
        optimize(context) {
            // Don't optimize variable blots
            return;
        }

        // Override length calculation
        length() {
            return 1; // Treat as single unit
        }

        // Override value method for proper Delta representation
        value() {
            return {
                variable: this.domNode.getAttribute('data-variable')
            };
        }
    }
    VariableBlot.blotName = 'variable';
    VariableBlot.tagName = 'span';
    VariableBlot.className = 'ql-variable-token';

    // Register the improved VariableBlot
    Quill.register(VariableBlot, true);


    // Initialize Quill Editor
    function initializeEditor(initialHTML = '') {
        const $wrapper = $('#text-editor-wrapper');
        if ($wrapper.length) {
            console.log('Removing existing .ql-toolbar from #text-editor-wrapper');
            $wrapper.find('.ql-toolbar').remove();
        }

        const $el = $('#text-content');
        if (!$el.length) {
            console.error('Editor container #text-content not found');
            return;
        }

        // Destroy existing Quill instance
        if (textEditor) {
            console.log('Destroying existing Quill editor');
            textEditor = null;
            $el.empty();
        }

        // Remove existing toolbar and container
        const $toolbar = $el.find('.ql-toolbar');
        const $container = $el.find('.ql-container');
        if ($toolbar.length) $toolbar.remove();
        if ($container.length) $container.remove();

        // Initialize Quill editor with improved configuration
        textEditor = new Quill($el[0], {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        [{ font: ['arial', 'times-new-roman', 'comic-sans-ms', 'courier-new', 'georgia', 'helvetica', 'lucida-sans'] }],
                        [{ size: ['10px', '12px', '14px', '16px', '18px', '20px', '22px', '24px', '36px', '48px', '72px'] }],
                        [{ align: [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ direction: 'rtl' }],
                        ['link'],
                        [
                            { color: ['hsl(0,0%,0%)', 'hsl(0,100%,50%)', 'hsl(120,100%,25%)', 'hsl(240,100%,50%)', 'hsl(60,100%,50%)', 'hsl(180,100%,50%)', 'hsl(300,100%,50%)'] },
                            { background: ['hsl(0,0%,100%)', 'hsl(0,100%,90%)', 'hsl(120,100%,90%)', 'hsl(240,100%,90%)', 'hsl(60,100%,90%)'] }
                        ],
                        [{ variable: '<i class="fas fa-tag"></i>' }],
                    ],
                    handlers: {
                        variable: () => {
                            console.log('Variable toolbar clicked, calling toggleDropdown');
                            if (toggleDropdown) toggleDropdown();
                        }
                    }
                },
                keyboard: {
                    bindings: {
                        // Disable default Enter behavior
                        'disable-default-enter': {
                            key: 13,
                            handler: () => {
                                console.log('Blocking default Enter behavior');
                                return false;
                            }
                        },
                        // Custom Enter handler
                        enter: {
                            key: 13,
                            handler: function (range, context) {
                                console.log('Enter pressed, range:', range, 'context:', context);

                                // Get the leaf at the current cursor position
                                const [blot, offset] = this.quill.getLeaf(range.index);
                                console.log('Current blot:', blot, 'Offset:', offset);

                                // Disable editor updates to prevent unintended changes
                                this.quill.enable(false);

                                // Clear any variable format at the cursor
                                this.quill.removeFormat(range.index, 0, 'user');

                                if (blot instanceof VariableBlot) {
                                    // Cursor is inside or at the end of a variable
                                    const blotIndex = this.quill.getIndex(blot);
                                    const blotLength = blot.length();
                                    console.log('Inside VariableBlot at index:', blotIndex, 'length:', blotLength);

                                    // Insert newline after the variable
                                    this.quill.insertText(blotIndex + blotLength, '\n', 'user');
                                    // Move cursor to the new line
                                    this.quill.setSelection(blotIndex + blotLength + 1, 0, 'user');
                                } else if (range.index > 0) {
                                    // Check if previous character is a variable
                                    const [prevBlot] = this.quill.getLeaf(range.index - 1);
                                    console.log('Previous blot:', prevBlot);
                                    if (prevBlot instanceof VariableBlot) {
                                        // Insert newline at current position
                                        this.quill.insertText(range.index, '\n', 'user');
                                        // Move cursor to the new line
                                        this.quill.setSelection(range.index + 1, 0, 'user');
                                    } else {
                                        // Normal text: insert newline
                                        this.quill.insertText(range.index, '\n', 'user');
                                        this.quill.setSelection(range.index + 1, 0, 'user');
                                    }
                                } else {
                                    // At the start of the editor or normal text
                                    this.quill.insertText(range.index, '\n', 'user');
                                    this.quill.setSelection(range.index + 1, 0, 'user');
                                }

                                // Log content after Enter
                                console.log('Content after Enter:', this.quill.getContents());

                                this.quill.enable(true);
                                return false; // Prevent any further default behavior
                            }
                        },
                        backspace: {
                            key: 8,
                            handler: function (range, context) {
                                if (range.length > 0) return true;
                                if (range.index === 0) return false;

                                const [prevBlot] = this.quill.getLeaf(range.index - 1);
                                if (prevBlot instanceof VariableBlot) {
                                    const blotIndex = this.quill.getIndex(prevBlot);
                                    this.quill.deleteText(blotIndex, prevBlot.length(), 'user');
                                    this.quill.setSelection(blotIndex, 0, 'user');
                                    return false;
                                }
                                return true;
                            }
                        },
                        delete: {
                            key: 46,
                            handler: function (range, context) {
                                if (range.length > 0) return true;

                                const [nextBlot] = this.quill.getLeaf(range.index);
                                if (nextBlot instanceof VariableBlot) {
                                    const blotIndex = this.quill.getIndex(nextBlot);
                                    this.quill.deleteText(blotIndex, nextBlot.length(), 'user');
                                    return false;
                                }
                                return true;
                            }
                        }
                    }
                }
            },
            placeholder: 'Start writing...'
        });

        // Add event listeners for better variable handling
        textEditor.on('text-change', function (delta, oldDelta, source) {
            if (source === 'user') {
                // Clean up any malformed variables after user changes
                cleanupVariables();
            }
        });

        // Add selection change handler to prevent cursor inside variables
        textEditor.on('selection-change', function (range, oldRange, source) {
            if (range && source === 'user') {
                const [blot, offset] = textEditor.getLeaf(range.index);
                if (blot instanceof VariableBlot && offset > 0 && offset < blot.length()) {
                    // Move cursor to after the variable
                    const blotIndex = textEditor.getIndex(blot);
                    textEditor.setSelection(blotIndex + blot.length(), 0, 'api');
                }
            }
        });

        // Initialize custom dropdown
        initializeCustomDropdown();

        // Set initial content
        if (initialHTML) {
            console.log('Setting initial content:', initialHTML);
            setEditorContent(initialHTML);
        }
    }

    function setEditorContent(htmlContent) {
        if (!textEditor || !htmlContent) return;

        // Parse HTML and convert variables to proper format
        const parser = new DOMParser();
        const doc = parser.parseFromString(htmlContent, 'text/html');

        // Find all variable tokens and ensure they're properly formatted
        const variableTokens = doc.querySelectorAll('.ql-variable-token');
        variableTokens.forEach(token => {
            const variable = token.getAttribute('data-variable');
            if (variable) {
                token.textContent = variable;
                token.setAttribute('contenteditable', 'false');
                // Remove any nested variable tokens
                const nestedTokens = token.querySelectorAll('.ql-variable-token');
                nestedTokens.forEach(nested => nested.remove());
            }
        });

        // Set content using clipboard for better format preservation
        const cleanHTML = doc.body.innerHTML;
        textEditor.clipboard.dangerouslyPasteHTML(cleanHTML);

        // Clean up after setting content
        setTimeout(() => {
            cleanupVariables();
        }, 100);
    }

    function cleanupVariables() {
        if (!textEditor) return;

        const editorContent = textEditor.root;
        const variableTokens = editorContent.querySelectorAll('.ql-variable-token');

        variableTokens.forEach(token => {
            const variable = token.getAttribute('data-variable');
            if (variable) {
                // Ensure proper formatting
                token.textContent = variable;
                token.setAttribute('contenteditable', 'false');

                // Remove any nested tokens
                const nestedTokens = token.querySelectorAll('.ql-variable-token');
                nestedTokens.forEach(nested => {
                    nested.remove();
                });
            }
        });
    }

    // 5. Enhanced dropdown functionality
    function initializeCustomDropdown() {
        const dropdownContainer = document.querySelector('#custom-variable-dropdown');
        if (!dropdownContainer) {
            console.warn('Dropdown container #custom-variable-dropdown not found');
            return;
        }

        const searchInput = dropdownContainer.querySelector('.dropdown-search');
        const optionList = dropdownContainer.querySelector('.dropdown-options');
        if (!optionList) {
            console.warn('Dropdown options list not found');
            return;
        }

        // Clear existing event listeners
        const options = Array.from(optionList.querySelectorAll('li'));
        options.forEach(option => {
            const newOption = option.cloneNode(true);
            option.parentNode.replaceChild(newOption, option);
        });

        const updatedOptions = Array.from(optionList.querySelectorAll('li'));

        function filterOptions(q) {
            const t = (q || '').toLowerCase();
            updatedOptions.forEach(o => {
                const v = o.textContent.toLowerCase();
                o.style.display = v.includes(t) ? '' : 'none';
            });
        }

        toggleDropdown = function () {
            dropdownContainer.classList.toggle('open');
            if (dropdownContainer.classList.contains('open')) {
                searchInput && searchInput.focus();
            } else if (searchInput) {
                searchInput.value = '';
                filterOptions('');
            }
        };

        if (searchInput) {
            const newSearchInput = searchInput.cloneNode(true);
            searchInput.parentNode.replaceChild(newSearchInput, searchInput);
            newSearchInput.addEventListener('input', () => filterOptions(newSearchInput.value));
        }

        updatedOptions.forEach(option => {
            const value = option.dataset.value || '';
            if (!value) {
                console.warn('No data-value attribute for dropdown option:', option);
                return;
            }

            option.addEventListener('click', () => {
                console.log('Inserting variable:', value);
                if (!textEditor) {
                    console.warn('textEditor not initialized');
                    return;
                }

                const range = textEditor.getSelection(true);
                if (!range) {
                    console.warn('No selection range available');
                    return;
                }

                // Insert variable as a single atomic unit
                textEditor.insertEmbed(range.index, 'variable', value, 'user');

                // Move cursor after the variable and add a space for better UX
                textEditor.insertText(range.index + 1, ' ', 'user');
                textEditor.setSelection(range.index + 2, 0, 'user');

                console.log('Variable inserted successfully');
                toggleDropdown();
            });
        });

        // Handle outside clicks
        document.addEventListener('click', function (e) {
            const isToolbarBtn = e.target.closest('.ql-variable');
            if (!dropdownContainer.contains(e.target) && !isToolbarBtn) {
                dropdownContainer.classList.remove('open');
                if (searchInput) {
                    searchInput.value = '';
                    filterOptions('');
                }
            }
        });
    }

    function showSuccessMessage(message) {
        const toast = $(`<div class="toast-notification success animate__animated animate__slideInRight">
                        <i class="fas fa-check-circle"></i> <span>${message}</span>
                    </div>`);
        $('body').append(toast);
        setTimeout(() => {
            toast.addClass('animate__slideOutRight');
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }

    // Show error message
    function showErrorMessage(message) {
        const toast = $(`<div class="toast-notification error animate__animated animate__slideInRight">
                        <i class="fas fa-exclamation-circle"></i> <span>${message}</span>
                    </div>`);
        $('body').append(toast);
        setTimeout(() => {

            toast.addClass('animate__slideOutRight');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    // Show loading overlay
    window.showLoading = function () {
        $('#loading').fadeIn(300);
        $('body').addClass('preload')

    }
    // Hide loading overlay
    function hideLoading() {
        $('#loading').fadeOut(300);
        $('body').removeClass('preload')
    }

    // Add Apply Layout button to every page
    function addApplyLayoutButton(page) {
        page.find('.apply-layout-btn').parent().remove();
        page.find('.page_content').append(`
                <div style="text-align: center; margin-bottom: 20px;" >
                    <button type="button" class="btn apply-layout-btn" style="opacity: 0;">
                        <i class="fas fa-plus"></i> Add Layout
                    </button>
                </div>
            `);
    }

    // Function to reapply sortable and resizable functionality
    function initializeSortableResizable(page) {
        enableLayoutSortable(page);

        page.find('.layout-row, .layout-col').each(function () {
            enableColumnSortable($(this)); // Reapply column sorting
            adjustColumnWidth($(this)); // Adjust column width
        });

        makeElementsResizable(page); // Reapply resizable functionality
    }

    function makeElementsDraggable(page) {
        // Make each element within the page draggable
        page.find('.element-wrapper').each(function () {
            $(this).draggable({
                handle: '.element-handle', // Only drag by handle
                containment: 'parent', // Limit dragging to the parent container
                cursor: 'move', // Show the move cursor while dragging
                start: function (event, ui) {
                    $(this).addClass('dragging'); // Add a class when dragging starts
                },
                stop: function (event, ui) {
                    $(this).removeClass('dragging'); // Remove the class when dragging stops
                }
            });
        });
    }

    // Back button in editor with confirmation
    $(document).on('click', '#back-button', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Any unsaved changes will be lost.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, go back',
            cancelButtonText: 'Cancel',
            background: '#f0f0f0',
            customClass: {
                popup: 'custom-popup',
                title: 'custom-title'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('.customize-proposal').fadeOut(300, function () {
                    $('.theme-selection').fadeIn(300);
                });

                $('#proposal_id').val('');
                $('#pages').empty();
                $('.proposals_name').val('');
                addApplyLayoutButton($('#page-1'));
                enableLayoutSortable($('#page-1'));
                makeElementsResizable($('#page-1'));

                Swal.fire({
                    title: 'Success',
                    text: 'Returned to template selection',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    background: '#f0f0f0',
                    customClass: {
                        popup: 'custom-popup',
                        title: 'custom-title'
                    }
                });
            }
        });
    });

    // Page selection
    $(document).on('click', '.page', function () {
        $('#pages .page').removeClass('selected');
        $(this).addClass('selected');
    });

    // Show layout modal
    $(document).on('click', '.apply-layout-btn', function () {
        window.modernLayoutTargetPage = $(this).closest('.page');
        $('#modernLayoutModal').modal('show');
    });

    // Apply layout
    $(document).on('click', '.layout-choice', function () {
        const cols = $(this).data('cols');
        const layoutId = `layout-${layoutIdCounter++}`;
        const layoutType = cols === 1 ? 'layout-col' : 'layout-row';
        const layoutCss = cols === 1 ? 'display: flex; flex-direction: column;  gap: 15px; position: relative;  min-height: 80px;  transition: all 0.3s ease;' : 'display: flex; gap: 15px; position: relative;  min-height: 80px;  transition: all 0.3s ease;';
        const layout = $(`
                <div class="${layoutType}" data-layout-id="${layoutId}" data-layout-type="${layoutType}" style="${layoutCss}">
                    <div class="layout-actions" style="opacity: 0;">
                        <div class="layout-handle"><i class="fas fa-arrows-alt"></i></div>
                        <button type="button" class="add-col"><i class="fas fa-plus"></i></button>
                        <button type="button" class="delete-layout"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `);

        for (let i = 0; i < cols; i++) {
            layout.append(createColumn(i));
        }

        window.modernLayoutTargetPage.find('.page_content').append(layout);
        addApplyLayoutButton(window.modernLayoutTargetPage);
        adjustColumnWidth(layout);
        enableColumnSortable(layout);
        enableLayoutSortable(window.modernLayoutTargetPage); // Ensure layouts are sortable
        $('#modernLayoutModal').modal('hide');
    });

    // Create column with enhanced UI and settings
    function createColumn(index) {
        return `
                <div class="col" data-col-id="col-${index}-${layoutIdCounter}" style="width: 50%; text-align: left;">
                    <div class="col-actions" style="opacity: 0;">
                        <div class="col-handle" data-tooltip="Drag to reorder"><i class="fas fa-grip-vertical"></i></div>
                        <button type="button" class="col-settings" data-tooltip="Column Settings"><i class="fas fa-cog"></i></button>
                        <button type="button" class="delete-col" data-tooltip="Delete Column"><i class="fas fa-trash"></i></button>
                        <button type="button" class="add-element" data-tooltip="Add Element"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="col-placeholder-text"  style="opacity: 0;" >
                        <i class="fas fa-plus-circle"></i>
                        <p>Click + to add content</p>
                    </div>
                </div>
            `;
    }

    // Adjust column width with proper calculation
    function adjustColumnWidth(layout) {
        console.log('Adjusting column width for layout:', layout.data('layout-id'));
        const cols = layout.find('.col');
        const totalCols = cols.length;
        const layoutType = layout.data('layout-type');

        if (totalCols === 0) return; // If no columns, exit function

        // Check if there's only one column, it should take full width
        if (layoutType === 'layout-col') {
            cols.css({
                'width': '100%',
                'flex': 'none', // Disable flex if there's only one column
                'min-width': '100%' // Ensure it takes full width
            });
        } else {
            // Calculate the width percentage for each column when there are multiple columns
            const baseWidth = 100 / totalCols;

            cols.each(function () {
                const $col = $(this);

                // Set column styles for responsiveness
                $col.css({
                    'width': `${baseWidth}%`,
                    //'flex': `1 1 ${baseWidth}%`, // Flexbox for responsive resizing
                    // 'min-width': totalCols > 2 ? '150px' : '200px', // Set a minimum width
                    'box-sizing': 'border-box', // Ensure padding and borders don't affect the width
                    'word-wrap': 'break-word' // Handle long text inside the column
                });

                // Adjust the content inside columns to fit properly
                $col.find('.element-wrapper').css({
                    'max-width': '100%', // Prevent overflow from inner elements
                    'word-wrap': 'break-word' // Wrap long text
                });
            });
        }

        makeColumnsResizable(layout); // Make the columns resizable after width adjustment
    }

    // Fixed column resize functionality
    function makeColumnsResizable(layout) {
        console.log('Making columns resizable for layout:', layout.data('layout-id'));
        layout.find('.col').each(function () {
            const $col = $(this);
            if ($col.data('ui-resizable')) {
                console.log('Element is already resizable, destroying.');
                try {
                    $col.resizable('destroy');
                } catch (e) {
                    console.warn('Error destroying resizable on column:', e.message);
                }
            } else {
                console.log('Element is not resizable, skipping destroy.');
            }
            $col.resizable({
                handles: 'e',
                minWidth: 50,
                start: function (event, ui) {
                    $(this).data('initial-width', $(this).width());
                    showSuccessMessage('Resizing column...');
                },
                resize: function (event, ui) {
                    const layoutWidth = layout.width();
                    const newWidth = ui.size.width;
                    const newPercentage = Math.max(10, Math.min(80, (newWidth / layoutWidth) * 100));
                    $col.css('width', newPercentage + '%');
                    const remainingCols = layout.find('.col').length - 1;
                    const remainingWidth = 100 - newPercentage;
                    const otherColWidth = remainingWidth / remainingCols;
                    layout.find('.col').not($col).each(function () {
                        $(this).css('width', otherColWidth + '%');
                    });
                },
                stop: function (event, ui) {
                    let totalWidth = 0;
                    layout.find('.col').each(function () {
                        totalWidth += parseFloat($(this).css('width'));
                    });
                    if (Math.abs(totalWidth - 100) > 1) {
                        const factor = 100 / totalWidth;
                        layout.find('.col').each(function () {
                            const currentWidth = parseFloat($(this).css('width'));
                            $(this).css('width', (currentWidth * factor) + '%');
                        });
                    }
                    showSuccessMessage('Column resized successfully!');
                }
            });
        });
    }

    // Enable layout sorting
    function enableLayoutSortable(page) {
        console.log('Enabling sortable for page:', page.attr('id'));
        page.find('.page_content').sortable({
            items: '.layout-row, .layout-col',
            handle: '.layout-handle',
            placeholder: 'sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            revert: 100,
            forceFallback: true,
            start: function (event, ui) {
                ui.helper.css('z-index', 1000);
            },
            stop: function (event, ui) {
                page.find('.layout-row, .layout-col').each(function () {
                    adjustColumnWidth($(this));
                });
            }
        });
    }

    // Perfect column sorting like sortable
    function enableColumnSortable(container) {
        console.log('Enabling perfect column sortable for container:', container.data('layout-id'));

        // Check if the sortable has been initialized
        if (container.data("ui-sortable")) {
            container.sortable('destroy');
        }

        // Initialize sortable
        container.sortable({
            items: '.col',
            handle: '.col-handle',
            placeholder: 'col-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'intersect',
            revert: 200,
            cursor: 'grabbing',
            opacity: 0.9,
            containment: container,
            axis: container.hasClass('layout-row') ? 'x' : 'y',
            scroll: true,
            scrollSensitivity: 100,
            scrollSpeed: 20,
            start: function (event, ui) {
                // Enhanced visual feedback
                ui.helper.css({
                    'z-index': 1000,
                    'transform': 'rotate(3deg)',
                });

                // Perfect placeholder sizing
                ui.placeholder.height(ui.helper.outerHeight());
                ui.placeholder.width(ui.helper.outerWidth());
                ui.placeholder.css({
                    'background': 'linear-gradient(45deg, rgba(116, 201, 17, 0.2) 25%, transparent 25%, transparent 75%, rgba(116, 201, 17, 0.2) 75%)',
                    'background-size': '20px 20px',
                    'animation': 'pulse 1.5s ease-in-out infinite alternate'
                });

                // Store original positions for smooth animation
                container.find('.col').each(function (index) {
                    $(this).data('original-index', index);
                });

                showSuccessMessage('Drag to reorder columns - Perfect sortable active!');
            },
            sort: function (event, ui) {
                // Real-time visual feedback during sorting
                ui.placeholder.addClass('animate__animated animate__pulse');
            },
            change: function (event, ui) {
                // Smooth animation for other columns
                container.find('.col:not(.ui-sortable-helper):not(.ui-sortable-placeholder)').each(function () {
                    $(this).addClass('animate__animated animate__slideInLeft');
                    setTimeout(() => {
                        $(this).removeClass('animate__animated animate__slideInLeft');
                    }, 300);
                });
            },
            stop: function (event, ui) {
                // Reset helper styles
                ui.item.css({
                    'transform': 'none',
                    'box-shadow': 'none',
                    'border': '2px dashed #dee2e6'
                });

                // Smooth completion animation
                ui.item.addClass('animate__animated animate__bounceIn');
                setTimeout(() => {
                    ui.item.removeClass('animate__animated animate__bounceIn');
                }, 600);

                // Recalculate column widths
                adjustColumnWidth(container);

                // Success feedback
                showSuccessMessage('Column reordered successfully! Perfect sortable complete.');
            },
            update: function (event, ui) {
                // Track the reordering for undo functionality
                console.log('Column order updated:', container.find('.col').map(function () {
                    return $(this).data('col-id');
                }).get());
            }
        });

        // Add hover effects for better UX
        container.find('.col-handle').hover(
            function () {
                $(this).css({
                    'background': 'var(--proposals-primary-hover)',
                    'transform': 'scale(1.1)',
                    'cursor': 'grab'
                });

            },
            function () {
                $(this).css({
                    'transform': 'scale(1)',
                    'cursor': 'move'
                });
            }
        );
    }

    // Delete layout
    $(document).on('click', '.delete-layout', function () {
        const page = $(this).closest('.page');
        $(this).closest('.layout-row, .layout-col').remove();
        addApplyLayoutButton(page);
    });

    // Add column
    $(document).on('click', '.add-col', function () {
        const layout = $(this).closest('.layout-row, .layout-col');
        layout.append(createColumn(layout.find('.col').length));
        adjustColumnWidth(layout);
        enableColumnSortable(layout);
    });

    // Delete column
    $(document).on('click', '.delete-col', function () {
        const layout = $(this).closest('.layout-row, .layout-col');
        $(this).closest('.col').remove();
        adjustColumnWidth(layout);
    });

    // Add Element
    $(document).on('click', '.add-element', function () {
        window.elementTargetCol = $(this).closest('.col');

        // Hide placeholder text when adding element
        // $(this).closest('.col').find('.col-placeholder-text').hide();

        $('#addElementsModalLabel').html('<i class="fas fa-plus-circle"></i> Add Element to Your Proposal');
        $('#edit-element-id').val('');
        $('#edit-element-type').val('');
        $('.element-form').removeClass('active');
        $('#element-options').show();


        // Reset all forms
        resetElementForms();

        $('#addElementsModal').modal('show');

        // Add animation to modal
        setTimeout(() => {
            $('#addElementsModal .modal-dialog').addClass('animate__animated animate__zoomIn');
        }, 100);
    });

    // Add Element Option
    $(document).on('click', '.add-element-option', function () {
        const type = $(this).data('type');
        $('#element-options').hide();
        $('.back-to-options').show();
        $('.element-form').removeClass('active');
        $('#' + type + '-form').addClass('active');

        if (type === 'text') {
            // Destroy existing editor before initializing
            if (textEditor) {
                textEditor = null;
                $('#text-content').empty();
            }
            setTimeout(() => initializeEditor(), 100);
        }
        if (type === 'lead-selector') {
            initializeLeadSelector && initializeLeadSelector();
        }
        if (type === 'table') {
            generateEnhancedTablePreview && generateEnhancedTablePreview();
        }
        $('#' + type + '-form').addClass('animate__animated animate__fadeIn');
    });

    // Initialize lead selector functionality
    function initializeLeadSelector() {
        $('#lead-selector').on('change', function () {
            const selectedOption = $(this).find('option:selected');
            const images = selectedOption.data('images');
            if (images && images.length > 0) {
                displayLeadImages(images);
                $('#lead-images-container').show();
            } else {
                $('#lead-images-container').hide();
                showErrorMessage('No images found for this lead');
            }
        });
    }

    // Display lead images in grid
    function displayLeadImages(images) {
        const grid = $('#lead-images-grid');
        grid.empty();

        images.forEach((image, index) => {
            const imageItem = $(`
                    <div class="image-item" data-image-url="${image.url}" data-image-name="${image.name || 'Image ' + (index + 1)}">
                        <img src="${image.url}" alt="${image.name || 'Lead Image'}">
                        <div class="image-overlay">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                `);

            imageItem.click(function () {
                addImageToProposal($(this).data('image-url'), $(this).data('image-name'));
            });

            grid.append(imageItem);
        });
    }

    // Add image to proposal with positioning
    function addImageToProposal(imageUrl, imageName) {
        const col = window.elementTargetCol;
        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        const elementId = `element-${elementIdCounter++}`;
        const element = $(`
                <div class="element-wrapper draggable-image animate__animated animate__fadeInUp"
                     data-element-id="${elementId}"
                     data-element-type="image"
                     style="position: relative; display: inline-block;">
                    <div class="image-controls">
                        <button type="button" class="move-to-top" data-tooltip="Move to Top"><i class="fas fa-arrow-up"></i></button>
                        <button type="button" class="center-image" data-tooltip="Center Image"><i class="fas fa-align-center"></i></button>
                        <button type="button" class="delete-element" data-tooltip="Delete Image"><i class="fas fa-trash"></i></button>
                    </div>
                    <img src="${imageUrl}" alt="${imageName}" style="max-width: 100%; height: auto; display: block;">
                </div>
            `);

        // Hide placeholder text
        col.find('.col-placeholder-text').hide();
        col.append(element);

        // Make image draggable and resizable
        makeImageDraggable(element);
        makeElementResizable(element);
        makeElementRemovableAndSortable(col, element);

        $('#addElementsModal').modal('hide');
        showSuccessMessage(`${imageName} added successfully!`);
    }

    // Back to element options with CKEditor cleanup
    $(document).on('click', '.back-to-options', function () {
        $('.element-form').removeClass('active');
        $('#element-options').show();
        $('.back-to-options').hide();

        // Destroy CKEditor instance
        if (textEditor) {
            textEditor = null;
        }

        resetElementForms();
    });

    // Reset element forms - with new elements
    function resetElementForms() {
        // Reset text form - content and color
        $('#text-color').val('#000000');

        // Reset image form
        $('#image-upload').val('');
        $('#image-preview').hide();

        // Reset table forms
        $('#table-rows').val(2);
        $('#table-cols').val(2);
        $('#table-headers').prop('checked', true);
        $('#table-preview-container').empty();

        // Reset product table form
        $('#product-table-rows').val(3);
        $('#product-table-headers').prop('checked', true);
        $('#product-table-preview-container').empty();

        // Reset PDF upload form
        $('#pdf-file-input').val('');
        $('#pdf-preview-container').hide();
        $('#pdf-pages-preview').empty();

        // Reset dynamic variable form
        $('#variable-selector').val('').trigger('change');

        // Reset lead selector
        $('#lead-selector').val('').trigger('change');
        $('#lead-images-container').hide();

        // Reset CKEditor content
        if (textEditor) {
            textEditor = null;
        }

        // Clear edit IDs
        $('#edit-element-id').val('');
        $('#edit-element-type').val('');
    }

    // Handle edit button click with enhanced functionality
    $(document).on('click', '.edit-element', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const element = $(this).closest('.element-wrapper, .dynamic-variable');
        if (!element.length) {
            console.error('No element-wrapper or dynamic-variable found for edit-element click');
            showErrorMessage && showErrorMessage('No valid element found to edit');
            return;
        }

        const elementId = element.data('element-id');
        const elementType = element.data('element-type');
        if (!elementId || !elementType) {
            console.error(`Invalid element data: ID=${elementId}, Type=${elementType}`);
            showErrorMessage && showErrorMessage('Invalid element data for editing');
            return;
        }

        window.elementTargetCol = element.closest('.col');

        $('#addElementsModalLabel').html('<i class="fas fa-edit"></i> Edit Element');
        $('#edit-element-id').val(elementId);
        $('#edit-element-type').val(elementType);
        $('#element-options, .element-selection-intro').hide();
        $('.element-form').removeClass('active');

        const form = $('#' + elementType + '-form');
        if (!form.length) {
            console.error(`Form #${elementType}-form not found`);
            showErrorMessage && showErrorMessage(`Form for ${elementType} not found`);
            return;
        }
        form.addClass('active');
        console.log('elementType', elementType);
        if (elementType === 'text') {
            const textElement = element.find('.element-text');
            const textContent = textElement.length && textElement.html() ? textElement.html() : '';
            // Destroy and reinitialize editor
            if (textEditor) {
                console.log('Destroying existing Quill editor');
                textEditor = null;
                $('#text-content').empty();
                $('#text-editor-wrapper').find('.ql-toolbar').remove();
            }
            setTimeout(() => {
                console.log('Initializing Quill editor with content:', textContent);
                initializeEditor(textContent);
            }, 100);
        } else if (elementType === 'image') {
            const img = element.find('img');
            if (img.length && img.attr('src')) {
                $('#image-preview').attr('src', img.attr('src')).show();
            } else {
                console.warn('No valid image found for editing');
                $('#image-preview').attr('src', '').hide();
            }
        } else if (elementType === 'table') {
            const table = element.find('table');
            if (table.length) {
                const rows = table.find('tbody tr').length || 0;
                const cols = table.find('tbody tr:first td').length || 0;
                const headers = table.find('thead').length > 0;
                $('#table-rows').val(rows);
                $('#table-cols').val(cols);
                $('#table-headers').prop('checked', headers);
                generateTablePreview && generateTablePreview();
            } else {
                console.warn('No valid table found for editing');
            }
        } else if (elementType === 'product-table') {
            const table = element.find('table');
            if (table.length) {
                const rows = table.find('tbody tr').length || 0;
                $('#product-table-rows').val(rows).trigger('input');
            } else {
                console.warn('No valid product table found for editing');
            }
        } else if (elementType === 'dynamic-variable') {
            const content = element.length && element.text() ? $.trim(element.text()) : '';
            if (content) {
                const match = content.match(/^(.+)?\{(.+)\}(.+)?$/);
                if (match && match[2]) {
                    const variableSelector = $('#variable-selector');
                    if (variableSelector.length) {
                        variableSelector.val(match[2]).trigger('change');
                    } else {
                        console.warn('Variable selector not found');
                    }
                } else {
                    console.warn('No valid variable format found in content:', content);
                }
            } else {
                console.warn('No content found for dynamic-variable');
            }
        } else {
            console.warn(`Unsupported element type: ${elementType}`);
        }

        const $modal = $('#addElementsModal');
        if ($modal.length) {
            $modal.modal('show');
            showSuccessMessage && showSuccessMessage('Element loaded for editing');
        } else {
            console.error('Modal #addElementsModal not found');
            showErrorMessage && showErrorMessage('Modal not found');
        }
    });
    // Convert RGB color to hex
    function rgbToHex(color) {
        if (!color || color === 'rgba(0, 0, 0, 0)') return '#000000';
        const rgb = color.match(/\d+/g);
        if (!rgb) return '#000000';
        const r = parseInt(rgb[0]).toString(16).padStart(2, '0');
        const g = parseInt(rgb[1]).toString(16).padStart(2, '0');
        const b = parseInt(rgb[2]).toString(16).padStart(2, '0');
        return `#${r}${g}${b}`;
    }

    // Bold specific word in text
    function boldSpecificWord(text, wordToBold) {
        if (!text.trim() || !wordToBold) return text;
        const escapedWord = wordToBold.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(`\\b${escapedWord}\\b`, 'gi');
        return text.replace(regex, `<b>${wordToBold}</b>`);
    }

    // Text element handling with color support
    $(document).on('click', '.add-text-element', function () {
        const col = window.elementTargetCol;

        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        // Get content from CKEditor (ensure it's sanitized and valid)
        let content = '';
        if (textEditor) {
            content = textEditor.root.innerHTML;
        }

        const editElementId = $('#edit-element-id').val();
        const textColor = $('#text-color').val() || '#000000';

        // Show loading state
        showLoading();

        // Check if it's editing or creating a new element
        if (editElementId) {
            // Edit existing element
            const element = col.find(`[data-element-id="${editElementId}"]`);

            if (element.length) {
                // Update content and styles
                element.find('.element-text').html(content).css({
                    'max-width': '100%',
                    'word-wrap': 'break-word',
                    'overflow-wrap': 'break-word',
                    'color': textColor
                });

                showSuccessMessage('Text element updated successfully!');
            }
        } else {
            // Create new element
            const elementId = `element-${elementIdCounter++}`;
            const element = $(`
            <div class="element-wrapper animate__animated animate__fadeInUp" data-element-id="${elementId}" data-element-type="text" style="position: relative;  margin: 5px 0px; transition: all 0.3s ease;">
                <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                    <button type="button" class="edit-element" data-tooltip="Edit Text"><i class="fas fa-edit"></i></button>
                    <button type="button" class="delete-element" data-tooltip="Delete Text"><i class="fas fa-trash"></i></button>
                    <div class="element-handle" data-tooltip="Drag to Move"><i class="fas fa-grip-vertical"></i></div>
                </div>
                <div class="element-text" style="max-width: 100%; word-wrap: break-word; overflow-wrap: break-word; color: ${textColor};">${content}</div>
            </div>
        `);

            // Hide placeholder text in the column
            col.find('.col-placeholder-text').hide();
            col.append(element);

            // Initialize the element with removable, sortable, and resizable features
            makeElementRemovableAndSortable(col, element);
            makeElementResizable(element); // Ensure the new element is resizable

            showSuccessMessage('Text element added successfully!');
        }

        // Hide loading indicator and reset form
        hideLoading();
        $('#addElementsModal').modal('hide');
        resetElementForms();
    });

    // Simplified image upload handler
    $(document).on('change', '#image-upload', function (e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', csrfToken); // Add CSRF token
            showLoading();

            $.ajax({
                url: `${baseurl}/upload_proposal_image`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#image-preview').attr('src', response.imagePath).show();
                        $('#image-info').show();
                        showSuccessMessage('Image uploaded successfully! You can resize it after adding.');
                        $('#image-upload').data('server-path', response.imagePath);
                        hideLoading();
                    } else {
                        showErrorMessage('Failed to upload image: ' + (response.message || 'Unknown error.'));
                        $('#image-upload').val('');
                        $('#image-preview').hide();
                        $('#image-info').hide();
                    }
                },
                error: function (xhr) {
                    showErrorMessage('Error uploading image: ' + (xhr.responseJSON?.message || 'Server error.'));
                    $('#image-upload').val('');
                    $('#image-preview').hide();
                    $('#image-info').hide();
                }
            });
        } else {
            showErrorMessage('Please upload a valid image file.');
            $(this).val('');
            $('#image-preview').hide();
            $('#image-info').hide();
        }
    });


    $(document).on('click', '.add-image-element', function () {
        const col = window.elementTargetCol;
        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        const fileInput = $('#image-upload')[0];
        const editElementId = $('#edit-element-id').val();
        if (!fileInput.files.length && !editElementId) {
            showErrorMessage('Please select an image.');
            return;
        }

        const serverImagePath = $('#image-upload').data('server-path'); // Get the server-uploaded image path

        if (editElementId) {
            // Editing an existing image element
            const element = col.find(`[data-element-id="${editElementId}"]`);
            if (serverImagePath) {
                element.find('img').attr('src', serverImagePath);
                makeElementResizable(element);
                showSuccessMessage('Image updated successfully!');
            } else {
                showErrorMessage('No valid image path available for update.');
                return;
            }
        } else {
            // Adding a new image element
            if (!serverImagePath) {
                showErrorMessage('No valid image uploaded.');
                return;
            }

            const elementId = `element-${elementIdCounter++}`;
            const element = $(`
            <div class="element-wrapper animate__animated animate__fadeInUp" data-element-id="${elementId}" data-element-type="image" style="position: relative; margin: 5px 0px;  transition: all 0.3s ease;">
                        <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                    <button type="button" class="edit-element" data-tooltip="Edit Image"><i class="fas fa-edit"></i></button>
                    <button type="button" class="delete-element" data-tooltip="Delete Image"><i class="fas fa-trash"></i></button>
                    <div class="element-handle" data-tooltip="Drag to Move"><i class="fas fa-grip-vertical"></i></div>
                </div>
                <img src="${serverImagePath}" class="draggable-image" alt="Uploaded Image" style="max-width: 100%; height: auto; display: block;">
            </div>
        `);

            col.find('.col-placeholder-text').hide();
            col.append(element);
            makeElementRemovableAndSortable(col, element);
            makeElementResizable(element);
            showSuccessMessage('Image added successfully! Use the resize handle to adjust size.');

            // Set the size of the element-wrapper based on the image size
            const image = element.find('.draggable-image');
            image.on('load', function () {
                const imageWidth = image.outerWidth();
                const imageHeight = image.outerHeight();
                element.css({
                    'width': imageWidth + 'px',
                    'height': imageHeight + 'px'
                });
            });
        }

        $('#addElementsModal').modal('hide');
        resetElementForms();
        $('#image-upload').data('server-path', ''); // Clear stored path after use
    });

    // Make the image draggable
    $(document).on('mouseenter', '.draggable-image', function () {
        const $this = $(this);
        if ($this.data('draggable')) {
            return;
        }
        const $wrapper = $this.closest('.element-wrapper');
        $this.draggable({
            containment: $wrapper.length ? $wrapper : 'parent', // Fallback to parent if no .element-wrapper is found
            cursor: 'move',
            revert: 'invalid', // Revert to original position if dropped outside a valid area
            start: function (event, ui) {
                $this.css('opacity', '0.7'); // Add slight opacity when dragging
                console.log('ui.position.top: ', ui.position.top);
                console.log('ui.position.left: ', ui.position.left);
                console.log('ui.position: ', ui.position);
            },
            stop: function (event, ui) {
                $this.css('opacity', '1'); // Reset opacity after drag stop
                console.log('ui.position.top: ', ui.position.top);
                console.log('ui.position.left: ', ui.position.left);
                console.log('ui.position: ', ui.position);
                $this.css({
                    'position': 'absolute',
                    'left': ui.position.left,
                    'top': ui.position.top
                });
            }
        });
        $this.data('draggable', true);
    });



    // Position image in container
    function positionImageInContainer(img, position) {
        const container = img.closest('.image-drop-zone');
        const containerWidth = container.width();
        const containerHeight = container.height();
        const imgWidth = img.width();
        const imgHeight = img.height();

        let left = 0,
            top = 0;

        switch (position) {
            case 'top-left':
                left = 10;
                top = 10;
                break;
            case 'top-center':
                left = (containerWidth - imgWidth) / 2;
                top = 10;
                break;
            case 'top-right':
                left = containerWidth - imgWidth - 10;
                top = 10;
                break;
            case 'center-left':
                left = 10;
                top = (containerHeight - imgHeight) / 2;
                break;
            case 'center':
                left = (containerWidth - imgWidth) / 2;
                top = (containerHeight - imgHeight) / 2;
                break;
            case 'center-right':
                left = containerWidth - imgWidth - 10;
                top = (containerHeight - imgHeight) / 2;
                break;
            case 'bottom-left':
                left = 10;
                top = containerHeight - imgHeight - 10;
                break;
            case 'bottom-center':
                left = (containerWidth - imgWidth) / 2;
                top = containerHeight - imgHeight - 10;
                break;
            case 'bottom-right':
                left = containerWidth - imgWidth - 10;
                top = containerHeight - imgHeight - 10;
                break;
        }

        img.css({
            left: left + 'px',
            top: top + 'px'
        });
    }

    // Make image draggable within container
    function makeImageDraggableInContainer(element) {
        const img = element.find('.draggable-image');
        const container = element.find('.image-drop-zone');

        img.draggable({
            containment: container,
            cursor: 'move',
            start: function (event, ui) {
                $(this).addClass('selected');
                container.find('.image-drop-zone-text').hide();
                showSuccessMessage('Drag to position the image');
            },
            stop: function (event, ui) {
                showSuccessMessage('Image positioned successfully');
            }
        });

        // Hide drop zone text when image is present
        container.find('.image-drop-zone-text').hide();
    }

    // Handle table element
    $(document).on('input', '#table-rows, #table-cols', function () {
        generateTablePreview();
    });

    $(document).on('change', '#table-headers', function () {
        generateTablePreview();
    });

    function generateTablePreview() {
        const rows = parseInt($('#table-rows').val()) || 1;
        const cols = parseInt($('#table-cols').val()) || 1;
        const headers = $('#table-headers').is(':checked');

        let tableHtml = '<table id="table-preview" class="enhanced-table">';
        if (headers) {
            tableHtml += '<thead><tr>';
            for (let j = 0; j < cols; j++) {
                tableHtml += `<th contenteditable="true">Header</th>`;
            }
            tableHtml += '</tr></thead>';
        }

        tableHtml += '<tbody>';
        for (let i = 0; i < rows; i++) {
            tableHtml += '<tr>';
            for (let j = 0; j < cols; j++) {
                tableHtml += `<td contenteditable="true"></td>`;
            }
            tableHtml += '</tr>';
        }
        tableHtml += '</tbody></table>';

        $('#table-preview-container').html(tableHtml);

        // Attach event listener for delete buttons
        attachDeleteRowHandlers('#table-preview-container');
    }
    $(document).on('click', '.add-table-element', function () {
        const col = window.elementTargetCol;
        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        const tableHtml = $('#table-preview-container').html();
        if (!tableHtml) {
            showErrorMessage('Please configure the table first');
            return;
        }

        const editElementId = $('#edit-element-id').val();
        let element;
        if (editElementId) {
            element = col.find(`[data-element-id="${editElementId}"]`);
            element.find('table').replaceWith(tableHtml);
        } else {
            const elementId = `element-${elementIdCounter++}`;
            element = $(`
            <div class="element-wrapper animate__animated animate__fadeInUp" data-element-id="${elementId}" data-element-type="table" style="position: relative;  margin: 5px 0px; transition: all 0.3s ease;">
                <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                    <button type="button" class="edit-table-content" data-tooltip="Edit Table"><i class="fas fa-edit"></i></button>
                    <button type="button" class="delete-element" data-tooltip="Delete Table"><i class="fas fa-trash"></i></button>
                    <div class="element-handle" data-tooltip="Drag to Move"><i class="fas fa-grip-vertical"></i></div>
                </div>
                ${tableHtml}
            </div>
        `);
            col.find('.col-placeholder-text').hide();
            col.append(element);
            makeElementRemovableAndSortable(col, element);
        }
        makeElementResizable(element);
        $('#addElementsModal').modal('hide');
        showSuccessMessage('Table added successfully!');
        resetElementForms();
    });

    // Handle product table element
    $(document).on('input', '#product-table-rows', function () {
        const rows = parseInt($(this).val()) || 1;
        let tableHtml = `
                <table id="table-preview">
                    <thead>
                        <tr>
                            <th contenteditable="true">Product Name</th>
                            <th contenteditable="true">Quantity</th>
                            <th contenteditable="true">Price</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
        for (let i = 0; i < rows; i++) {
            tableHtml += `
                    <tr>
                        <td contenteditable="true">Product ${i + 1}</td>
                        <td contenteditable="true">$10</td>
                        <td contenteditable="true">1</td>
                    </tr>
                `;
        }
        tableHtml += '</tbody></table>';
        $('#product-table-preview-container').html(tableHtml);
    });

    $(document).on('click', '.add-product-table-element', function () {
        const col = window.elementTargetCol;
        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        const tableHtml = $('#product-table-preview-container').html();
        if (!tableHtml) {
            showErrorMessage('Please configure the product table first');
            return;
        }

        const editElementId = $('#edit-element-id').val();
        let element;
        if (editElementId) {
            element = col.find(`[data-element-id="${editElementId}"]`);
            element.find('table').replaceWith(tableHtml);
        } else {
            const elementId = `element-${elementIdCounter++}`;
            element = $(`
            <div class="element-wrapper animate__animated animate__fadeInUp" data-element-id="${elementId}" data-element-type="product-table" style="position: relative;  margin: 5px 0px; transition: all 0.3s ease;">
                <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                    <button type="button" class="edit-table-content" data-tooltip="Edit Table"><i class="fas fa-edit"></i></button>
                    <button type="button" class="delete-element" data-tooltip="Delete Table"><i class="fas fa-trash"></i></button>
                    <div class="element-handle" data-tooltip="Drag to Move"><i class="fas fa-grip-vertical"></i></div>
                </div>
                ${tableHtml}
            </div>
        `);
            col.find('.col-placeholder-text').hide();
            col.append(element);
            makeElementRemovableAndSortable(col, element);
        }
        makeElementResizable(element);
        $('#addElementsModal').modal('hide');
        showSuccessMessage('Product table added successfully!');
        resetElementForms();
    });

    // Handle dynamic variable
    $(document).on('change', '#variable-selector', function () {
        const preview = $(this).find('option:selected').data('preview') || '';
        $('#variable-preview').text(preview);
    });

    $(document).on('click', '.add-dynamic-variable-element', function () {
        const col = window.elementTargetCol;
        if (!col) return;

        const value = $('#variable-selector').val();
        if (!value) {
            Swal.fire({
                title: 'Invalid Input',
                text: 'Please select a variable.',
                icon: 'error',
                confirmButtonText: 'OK',
                background: '#f0f0f0',
                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title'
                }
            });
            return;
        }

        const editElementId = $('#edit-element-id').val();
        if (editElementId) {
            const element = col.find(`[data-element-id="${editElementId}"]`);
            const prefix = $('#variable-prefix').val();
            const suffix = $('#variable-suffix').val();
            const content = `${prefix}{${value}}${suffix}`;
            element.text(content);
            makeElementResizable(element);
        } else {
            const elementId = `element-${elementIdCounter++}`;
            const prefix = $('#variable-prefix').val();
            const suffix = $('#variable-suffix').val();
            const content = `${prefix}{${value}}${suffix}`;
            const element = $(`
            <span class="dynamic-variable" data-element-id="${elementId}" data-element-type="dynamic-variable" style="display: inline-block; padding: 5px; margin: 5px; border: 1px dashed #ccc; background: #f8f9fa;">
                ${content}
            </span>
        `);
            col.append(element);
            makeElementRemovableAndSortable(col, element);
            makeElementResizable(element);
        }
        $('#addElementsModal').modal('hide');
        resetElementForms();
    });

    // Reset element forms
    function resetElementForms() {
        $('.element-form').removeClass('active');
        $('#element-options').show();
        // $('#text-content').html('');
        $('#text-bold-word').val('');
        $('#text-font-size').val('16');
        $('#text-font-color').val('#000000');
        $('#text-font-weight').val('normal');
        $('#text-align').val('left');
        $('#image-upload').val('');
        $('#image-preview').hide().attr('src', '');
        $('#table-rows').val('');
        $('#table-cols').val('');
        $('#table-headers').prop('checked', true);
        $('#table-preview-container').empty();
        $('#product-table-rows').val('');
        $('#product-table-preview-container').empty();
        $('#variable-selector').val('').trigger('change');
        $('#variable-preview').empty();
        $('#variable-prefix').val('');
        $('#variable-suffix').val('');
        $('#edit-element-id').val('');
        $('#edit-element-type').val('');
        $('#addElementsModalLabel').text('Add Element');
    }

    // Make elements removable and sortable
    function makeElementRemovableAndSortable(col, element) {
        element.append(`
                        <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                    <div class="element-handle" title="Move">
                        <i class="fas fa-arrows-alt"></i>
                    </div>
                    <button type="button" class="edit-element" title="Edit">
                        <i class="fas fa-pen"></i>
                    </button>
                    <button type="button" class="delete-element" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `);

        col.sortable({
            items: '.element-wrapper, .dynamic-variable',
            handle: '.element-handle',
            placeholder: 'element-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            revert: 100,
            forceFallback: true,
            start: function (event, ui) {
                ui.helper.css('z-index', 1000);
            }
        });
    }

    function makeElementResizable(element) {
        // Ensure element is valid
        if (!element || element.length === 0 || element[0].nodeType !== 1) {
            console.warn('Invalid element for resizable:', element);
            return;
        }

        // Check if the element is actively resizable
        if ($(element).data('ui-resizable')) {
            console.log('Element is already resizable, destroying.');
            try {
                $(element).resizable('destroy');
            } catch (e) {
                console.warn('Error destroying resizable:', e.message);
            }
        } else {
            console.log('Element is not resizable, skipping destroy.');
        }

        // Initialize resizable
        $(element).resizable({
            handles: 'se',
            minWidth: 50,
            minHeight: 30,
            aspectRatio: $(element).data('element-type') === 'image',
            start: function (event, ui) {
                showSuccessMessage('Resize the element by dragging the handle');
            },
            resize: function (event, ui) {
                const content = ui.element.find('img, .element-text, table');
                if (content.length) {
                    content.css({
                        'max-width': '100%',
                        'max-height': '100%',
                        'width': 'auto',
                        'height': 'auto'
                    });
                }
            },
            stop: function (event, ui) {
                showSuccessMessage('Element resized successfully');
            }
        });
    }

    // This function ensures that all elements inside the container are made resizable
    function makeElementsResizable(container) {
        container.find('.element-wrapper').each(function () {
            makeElementResizable($(this)); // Call makeElementResizable for each element
        });
    }

    // Delete element
    $(document).on('click', '.delete-element', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).closest('.element-wrapper, .dynamic-variable').remove();
    });

    $(document).on('submit', '#proposalForm', function (e) {
        $('#save-proposal').prop('disabled', true);
        e.preventDefault();
        const form = $(this);


        // Check if #page-1 exists
        const $page1 = $('#page-1');
        if (!$page1.length) {
            console.error('Element #page-1 not found in the DOM');
            Swal.fire({
                title: 'Error',
                text: 'Page element not found. Cannot generate screenshot.',
                icon: 'error',
                confirmButtonText: 'OK',
                background: '#f0f0f0',
                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title'
                }
            });
            return; // Stop execution
        }
        // Initialize total price accumulator
        let grandTotal = 0;

        // Prepare HTML to display totals for each product table
        let productTotalsHTML = '';

        if ($('.product-table').length === 0) {
            console.log('No product tables found in the DOM');
            productTotalsHTML += ``;
        } else {
            $('.product-table').each(function (index) {
                let tableTotal = 0;
                const $rows = $(this).find('tbody tr'); // Only get tbody rows, not header rows

                if ($rows.length === 0) {
                    console.warn(`Table ${index + 1} has no rows`);
                } else {
                    $rows.each(function (rowIndex) {
                        const priceText = $(this).find('td:nth-child(4)').text();
                        console.log(`Table ${index + 1},  ${rowIndex + 1} price text: "${priceText}"`);

                        const quantityText = $(this).find('td:nth-child(3)').text();
                        console.log(`Table ${index + 1}, Row ${rowIndex + 1} quantity text: "${quantityText}"`);

                        // Clean and parse the values
                        const cleanPriceText = priceText.replace(/[^0-9.]/g, '');
                        const cleanQuantityText = quantityText.replace(/[^0-9.]/g, '');

                        const price = parseFloat(cleanPriceText);
                        const quantity = parseFloat(cleanQuantityText);

                        console.log(`Parsed price: ${price}, quantity: ${quantity}`);

                        // Calculate line total (price × quantity)
                        if (!isNaN(price) && !isNaN(quantity)) {
                            const lineTotal = price * quantity;
                            tableTotal += lineTotal;
                            console.log(`Line total: ${lineTotal}`);
                        }
                    });
                }

                grandTotal += tableTotal;
                productTotalsHTML += `
        <div class="product-total">
            <p><strong>Total for Table ${index + 1}:</strong> $${tableTotal.toFixed(2)}</p>
        </div>
    `;
            });

            // Append the grand total
            productTotalsHTML += `
            <div class="product-total">
                <p><strong>Grand Total for all product tables:</strong> $${grandTotal.toFixed(2)}</p>
            </div>
        `;
        }
        // Get the last page id dynamically (it will be the last page in the list)
        const lastPageId = $('#pages .page').last().data('page-id') + 1 || 1; // Add 1 to the last page id or default to 1 if no pages are present

        // Append the product totals dynamically to the "Authorization Page"
        const $authorizationPage = $('#authorization-page');
        if (!$authorizationPage.length) {
            $('#pages').append(`
            <div class="page authorization_page" id="page-${lastPageId}" data-page-id="${lastPageId}" style="background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 800px; height: 1000px; margin: 0 auto 30px; position: relative; overflow: hidden; cursor: pointer; transition: all 0.3s ease;padding: 120px 30px 50px 30px;box-sizing: border-box;">
               
                <div class="page_content ui-sortable" style="height: 100%;">
                    <div class="theme_type_box">${themeType}</div>
                    <div id="authorization-page">
                        <h2>AUTHORIZATION PAGE</h2>
                        ${productTotalsHTML}
                         <div style="">
                    <h3>Signature</h3>
                    <div class="signature-box" data-id="customer_signature_1">
    <canvas class="signature-canvas" style="border: 1px solid #000; width: 100%; height: 150px;" width="638" height="148"></canvas>
</div>

                    <div>
                        <button id="clear-signature" class="clear-signature-btn" style="margin-top: 10px;">Clear Signature</button>
                    </div>
                </div>
            </div>
        `);
        }

        const pageContent = $('#pages').html();
        $('#description').val(pageContent);

        // Generate screenshot for the first page
        html2canvas($page1[0], {
            scale: 2,
            useCORS: true,
            allowTaint: false
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/webp');

            // Get page-id and validate
            const pageId = $page1.data('page-id');
            let pageIndex = '';
            if (typeof pageId === 'string') {
                pageIndex = pageId.replace('proposal-page-', '');
            } else {
                console.warn('Invalid or missing data-page-id, using default value');
                pageIndex = '1'; // Fallback value
            }


            // Upload screenshot to upload_proposal_screen_shot endpoint
            const formData = new FormData();
            // formData.append('_token', '{{ csrf_token() }}');
            formData.append('_token', csrfToken);
            formData.append('image', imgData);
            formData.append('page_index', pageIndex);

            $.ajax({
                // url: "{{ route('upload_proposal_screen_shot') }}",
                url: `${baseurl}/upload_proposal_screen_shot`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Set form fields with the image from server response
                    if (response.imagePath) {
                        $('#screen_shot').val(response.imagePath);
                        $('#preview_image_screenshoot').val(response.imagePath);
                    } else {
                        console.warn('No image data in response, using local image data as fallback');
                        $('#screen_shot').val('');
                        $('#preview_image_screenshoot').val('');
                    }

                    // Proceed with form submission
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function (response) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Proposal saved successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                background: '#f0f0f0',
                                customClass: {
                                    popup: 'custom-popup',
                                    title: 'custom-title'
                                }
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error("Form submission error:", error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to save proposal. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                background: '#f0f0f0',
                                customClass: {
                                    popup: 'custom-popup',
                                    title: 'custom-title'
                                }
                            });
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Screenshot upload error:", error);
                    // Fallback to local image data if upload fails
                    $('#screen_shot').val('');
                    $('#preview_image_screenshoot').val('');

                    // Proceed with form submission despite screenshot upload failure
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function (response) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Proposal saved successfully (screenshot upload failed)!',
                                icon: 'warning',
                                confirmButtonText: 'OK',
                                background: '#f0f0f0',
                                customClass: {
                                    popup: 'custom-popup',
                                    title: 'custom-title'
                                }
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error("Form submission error:", error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to save proposal. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                background: '#f0f0f0',
                                customClass: {
                                    popup: 'custom-popup',
                                    title: 'custom-title'
                                }
                            });
                        }
                    });
                }
            });
        }).catch(error => {
            console.error("html2canvas error:", error);
            Swal.fire({
                title: 'Error',
                text: 'Failed to generate screenshot. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK',
                background: '#f0f0f0',
                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title'
                }
            });
        });
    });


    // Close menus on click outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.settings-btn, .settings-menu').length) {
            $('.settings-menu').hide();
        }
    });

    // Prevent click propagation on handles
    $(document).on('click', '.layout-handle, .col-handle, .element-handle', function (e) {
        e.stopPropagation();
    });

    // Make elements removable and sortable
    function makeElementRemovableAndSortable(col, element) {
        // Add delete functionality
        element.find('.delete-element').click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this element?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    element.addClass('animate__animated animate__fadeOut');
                    setTimeout(() => {
                        element.remove();

                        // Show placeholder if no elements left
                        if (col.find('.element-wrapper').length === 0) {
                            col.find('.col-placeholder-text').show();
                        }

                        showSuccessMessage('Element deleted successfully');
                    }, 300);
                }
            });
        });

        // Make elements sortable within columns
        if (!col.hasClass('ui-sortable')) {
            col.sortable({
                items: '.element-wrapper',
                handle: '.element-handle',
                placeholder: 'element-placeholder',
                tolerance: 'pointer',
                cursor: 'move',
                opacity: 0.8,
                start: function (event, ui) {
                    ui.helper.css('z-index', 1000);
                    ui.placeholder.height(ui.helper.outerHeight());
                },
                stop: function (event, ui) {
                    showSuccessMessage('Element reordered successfully');
                }
            });
        }
    }



    // Initialize everything when document is ready

    // Click on placeholder to add element
    $(document).on('click', '.col-placeholder-text', function () {
        $(this).siblings('.col-actions').find('.add-element').click();
    });


    // $('#addElementsModal').on('shown.bs.modal', function () {
    //     setTimeout(() => {
    //         resetElementForms();
    //
    //     }, 100);
    // });

    // Generate enhanced table preview
    function generateEnhancedTablePreview() {
        const rows = parseInt($('#table-rows').val()) || 2;
        const cols = parseInt($('#table-cols').val()) || 2;
        const hasHeaders = $('#table-headers').is(':checked');
        const equalCells = $('#table-equal-cells').is(':checked');
        const fontFamily = $('#table-font-family').val() || 'Arial';
        const fontSize = $('#table-font-size').val() || '12';
        const textColor = $('#table-text-color').val() || '#000000';


        let tableHtml = `<table class="enhanced-table" style="font-family: ${fontFamily}; font-size: ${fontSize}px; color: ${textColor};">`;

        // Calculate cell width for equal sizing
        const cellWidth = equalCells ? `${100 / cols}%` : 'auto';
        const cellHeight = equalCells ? '40px' : 'auto';

        // Add headers if enabled
        if (hasHeaders) {
            tableHtml += '<thead><tr>';
            for (let j = 0; j < cols; j++) {
                tableHtml += `<th style="width: ${cellWidth}; height: ${cellHeight};font-family: ${fontFamily}; font-size: ${fontSize}px; color: ${textColor};" contenteditable="true">Header ${j + 1}</th>`;
            }
            tableHtml += '</tr></thead>';
        }

        // Add body rows
        tableHtml += '<tbody>';
        for (let i = 0; i < rows; i++) {
            tableHtml += '<tr>';
            for (let j = 0; j < cols; j++) {
                const cellContent = (i === 0 && j === 0 && autoDate) ? '05/08/2025' : `Cell ${i + 1}-${j + 1}`;
                tableHtml += `<td style="width: ${cellWidth}; height: ${cellHeight};font-family: ${fontFamily}; font-size: ${fontSize}px; color: ${textColor};" contenteditable="true" data-auto-date="${autoDate}">${cellContent}</td>`;
            }
            tableHtml += '</tr>';
        }
        tableHtml += '</tbody></table>';

        $('#table-preview-container').html(tableHtml);

        // Add date functionality if enabled
        if (autoDate) {
            addDateFunctionality();
        }
    }

    // Add date functionality to table cells
    function addDateFunctionality() {
        $('#table-preview-container').off('dblclick', 'td[data-auto-date="true"]').on('dblclick', 'td[data-auto-date="true"]', function () {
            const cell = $(this);
            const currentValue = cell.text();

            // Check if it's a date format
            const dateRegex = /^\d{2}\/\d{2}\/\d{4}$/;
            if (dateRegex.test(currentValue) || currentValue.includes('Cell')) {
                // Create date input
                const dateInput = $(`<input type="date" class="date-input" value="">`);

                // Convert DD/MM/YYYY to YYYY-MM-DD for input
                if (dateRegex.test(currentValue)) {
                    const parts = currentValue.split('/');
                    const isoDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                    dateInput.val(isoDate);
                }

                cell.html(dateInput);
                dateInput.focus();

                // Handle date selection
                dateInput.on('change blur', function () {
                    const selectedDate = $(this).val();
                    if (selectedDate) {
                        // Convert YYYY-MM-DD to DD/MM/YYYY
                        const parts = selectedDate.split('-');
                        const formattedDate = `${parts[2]}/${parts[1]}/${parts[0]}`;
                        cell.text(formattedDate);
                    } else {
                        cell.text(currentValue);
                    }
                });
            }
        });
    }

    // Make images draggable and positionable
    function makeImageDraggable(element) {
        element.draggable({
            containment: element.closest('.page'),
            cursor: 'move',
            start: function (event, ui) {
                $(this).addClass('selected');
                showSuccessMessage('Drag to position the image anywhere on the page');
            },
            stop: function (event, ui) {
                showSuccessMessage('Image positioned successfully');
            }
        });

        // Add positioning controls
        element.find('.move-to-top').click(function () {
            element.css({
                'position': 'absolute',
                'top': '10px',
                'left': '50%',
                'transform': 'translateX(-50%)',
                'z-index': '10'
            });
            showSuccessMessage('Image moved to top center');
        });

        element.find('.center-image').click(function () {
            element.css({
                'position': 'absolute',
                'top': '50%',
                'left': '50%',
                'transform': 'translate(-50%, -50%)',
                'z-index': '10'
            });
            showSuccessMessage('Image centered on page');
        });
    }

    // Enhanced table generation on input change
    $(document).on('input change', '#table-rows, #table-cols, #table-font-family, #table-font-size, #table-text-color', function () {
        generateEnhancedTablePreview();
    });

    $(document).on('change', '#table-headers, #table-equal-cells', function () {
        generateEnhancedTablePreview();
    });

    // Enhanced table element addition
    $(document).on('click', '.add-table-element', function () {
        const col = window.elementTargetCol;
        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        const tableHtml = $('#table-preview-container').html();
        if (!tableHtml) {
            showErrorMessage('Please configure the table first');
            return;
        }

        const elementId = `element-${elementIdCounter++}`;
        const element = $(`
                <div class="element-wrapper animate__animated animate__fadeInUp" data-element-id="${elementId}" data-element-type="table" style="position: relative; margin: 5px 0px;  transition: all 0.3s ease;">
                        <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                        <button type="button" class="edit-element" data-tooltip="Edit Table"><i class="fas fa-edit"></i></button>
                        <button type="button" class="delete-element" data-tooltip="Delete Table"><i class="fas fa-trash"></i></button>
                        <div class="element-handle" data-tooltip="Drag to Move"><i class="fas fa-grip-vertical"></i></div>
                    </div>
                    ${tableHtml}
                </div>
            `);

        // Hide placeholder text
        col.find('.col-placeholder-text').hide();
        col.append(element);
        makeElementRemovableAndSortable(col, element);
        makeElementResizable(element);


        $('#addElementsModal').modal('hide');
        showSuccessMessage('Enhanced table added successfully!');
    });

    // Column settings functionality
    let currentColumn = null;

    $(document).on('click', '.col-settings', function (e) {
        e.preventDefault();
        e.stopPropagation();

        currentColumn = $(this).closest('.col');

        // Get current column settings
        const currentAlign = currentColumn.css('text-align') || 'left';
        const currentVAlign = currentColumn.css('vertical-align') || 'top';
        const currentPadding = parseInt(currentColumn.css('padding')) || 15;
        const currentBgColor = rgbToHex(currentColumn.css('background-color')) || '#ffffff';

        // Set form values
        $('#column-alignment').val(currentAlign);
        $('#column-vertical-alignment').val(currentVAlign);
        $('#column-padding').val(currentPadding);
        $('#column-bg-color').val(currentBgColor);
        $('#padding-value').text(currentPadding + 'px');

        $('#columnSettingsModal').modal('show');
    });

    // Update padding value display
    $(document).on('input', '#column-padding', function () {
        $('#padding-value').text($(this).val() + 'px');
    });

    // Apply column settings
    $(document).on('click', '#apply-column-settings', function () {
        if (!currentColumn) return;

        const alignment = $('#column-alignment').val();
        const vAlignment = $('#column-vertical-alignment').val();
        const padding = $('#column-padding').val();
        const bgColor = $('#column-bg-color').val();

        // Apply settings to column
        currentColumn.css({
            'text-align': alignment,
            'vertical-align': vAlignment,
            'padding': padding + 'px',
            'background-color': bgColor,
            'display': 'flex',
            'flex-direction': 'column',
            'justify-content': vAlignment === 'top' ? 'flex-start' : vAlignment === 'middle' ? 'center' : 'flex-end'
        });

        // Apply alignment to all content in column
        currentColumn.find('.element-text, .element-wrapper').css({
            'text-align': alignment
        });

        $('#columnSettingsModal').modal('hide');
        showSuccessMessage('Column settings applied successfully!');
    });

    // RGB to Hex converter
    function rgbToHex(rgb) {
        if (!rgb || rgb === 'rgba(0, 0, 0, 0)' || rgb === 'transparent') return '#ffffff';

        const result = rgb.match(/\d+/g);
        if (!result) return '#ffffff';

        return "#" + ((1 << 24) + (parseInt(result[0]) << 16) + (parseInt(result[1]) << 8) + parseInt(result[2])).toString(16).slice(1);
    }

    // PDF Upload Functionality
    document.getElementById("pdf-file-input").addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file && file.type === 'application/pdf') {
            showLoading();
            document.getElementById('pdf-details').textContent = `PDF: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            document.getElementById('pdf-preview-container').style.display = 'block';

            // Load and render PDF pages as images
            const reader = new FileReader();
            reader.onload = function (e) {
                const arrayBuffer = e.target.result;
                const pdfDoc = pdfjsLib.getDocument({
                    data: arrayBuffer // Pass the PDF data as an array buffer
                });

                pdfDoc.promise.then(function (pdf) {
                    const totalPages = pdf.numPages;
                    displayPDFPages(pdf, totalPages);
                });
            };
            reader.readAsArrayBuffer(file);
        } else {
            showErrorMessage('Please select a valid PDF file');
        }
    });

    // Display PDF pages as images with checkboxes
    function displayPDFPages(pdf, totalPages) {
        const grid = document.getElementById('pdf-pages-preview');
        grid.innerHTML = ''; // Clear previous previews

        // Create array to store page elements in correct order
        const pageElements = new Array(totalPages);
        let loadedPages = 0;

        for (let i = 1; i <= totalPages; i++) {
            pdf.getPage(i).then(function (page) {
                const scale = 0.8;
                const viewport = page.getViewport({
                    scale: scale
                });
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                return page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise.then(function () {
                    const img = new Image();
                    img.src = canvas.toDataURL('image/webp');

                    const pageItem = document.createElement('div');
                    pageItem.className = 'pdf-page-item';
                    pageItem.dataset.page = i;
                    pageItem.style.cssText = 'position: relative; border: 2px solid #ddd; border-radius: 8px; padding: 10px; margin: 10px; background: white;';

                    // Create checkbox
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.checked = true; // Default checked
                    checkbox.className = 'page-checkbox';
                    checkbox.dataset.page = i;
                    checkbox.style.cssText = 'position: absolute; top: 10px; left: 10px; width: 18px; height: 18px; z-index: 10;';


                    const pagePreview = document.createElement('div');
                    pagePreview.className = 'pdf-page-preview';
                    pagePreview.style.cssText = 'margin-top: 25px;'; // Space for checkbox
                    pagePreview.appendChild(img);

                    const pageNumber = document.createElement('div');
                    pageNumber.className = 'pdf-page-number';
                    pageNumber.textContent = `Page ${i}`;
                    pageNumber.style.cssText = 'text-align: center; margin-top: 10px; font-weight: bold;';

                    // Add click event to toggle checkbox when clicking on page
                    pageItem.addEventListener('click', function (e) {
                        if (e.target !== checkbox) {
                            checkbox.checked = !checkbox.checked;
                            updatePageSelection(pageItem, checkbox.checked);
                        }
                    });

                    // Add change event to checkbox
                    checkbox.addEventListener('change', function () {
                        updatePageSelection(pageItem, this.checked);
                    });

                    pageItem.appendChild(checkbox);
                    pageItem.appendChild(pagePreview);
                    pageItem.appendChild(pageNumber);

                    // Store in correct position
                    pageElements[i - 1] = pageItem;
                    loadedPages++;

                    // If all pages loaded, append them in order
                    if (loadedPages === totalPages) {
                        pageElements.forEach(element => {
                            grid.appendChild(element);
                        });
                        hideLoading();
                        showSuccessMessage(`${totalPages} PDF pages loaded`);
                    }
                });
            });
        }
    }

    // Update page visual selection state
    function updatePageSelection(pageItem, isSelected) {
        if (isSelected) {
            pageItem.style.border = '2px solid #007bff';
            pageItem.style.backgroundColor = '#f8f9fa';
        } else {
            pageItem.style.border = '2px solid #ddd';
            pageItem.style.backgroundColor = 'white';
        }
    }

    // Product Table Generation
    $(document).on('input change', '#product-table-rows', function () {
        generateProductTablePreview();
    });

    $(document).on('change', '#product-table-headers', function () {
        generateProductTablePreview();
    });

    function generateProductTablePreview() {
        const rows = parseInt($('#product-table-rows').val()) || 3;
        const hasHeaders = $('#product-table-headers').is(':checked');

        let tableHtml = '<table class="product-table">';

        // Add headers if enabled
        if (hasHeaders) {
            tableHtml += '<thead><tr>';
            tableHtml += '<th class="checkbox-cell"><input type="checkbox" checked></th>';
            tableHtml += '<th>Description</th>';
            tableHtml += '<th>Quantity</th>';
            tableHtml += '<th>Price</th>';
            tableHtml += '</tr></thead>';
        }

        // Add body rows
        tableHtml += '<tbody>';
        for (let i = 0; i < rows; i++) {
            tableHtml += '<tr>';
            tableHtml += '<td class="checkbox-cell"><input type="checkbox" checked></td>';
            tableHtml += `<td contenteditable="true">Description</td>`;
            tableHtml += `<td contenteditable="true"></td>`;
            tableHtml += `<td contenteditable="true"></td>`;
            // Add delete button for each row
            tableHtml += '</tr>';
        }
        tableHtml += '</tbody></table>';

        $('#product-table-preview-container').html(tableHtml);

        // Attach event listener for delete buttons
        attachDeleteRowHandlers('#product-table-preview-container');
    }

    function attachDeleteRowHandlers(containerSelector) {
        $(containerSelector).find('.delete-row-btn').off('click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const $button = $(this);
            const rowIndex = $button.data('row');
            const $table = $button.closest('table');
            const $row = $button.closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this row?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $row.remove();

                    // Update row count input
                    const $rowsInput = containerSelector.includes('product-table') ? $('#product-table-rows') : $('#table-rows');
                    const currentRows = parseInt($rowsInput.val()) || 1;
                    $rowsInput.val(currentRows - 1).trigger('input');

                    showSuccessMessage('Row deleted successfully!');

                    // Update data-row attributes for remaining rows
                    $table.find('tbody tr').each(function (index) {
                        $(this).find('.delete-row-btn').data('row', index);
                    });
                }
            });
        });
    }
    // Add Product Table Element
    $(document).on('click', '.add-product-table-element', function () {
        const col = window.elementTargetCol;
        if (!col) {
            showErrorMessage('Please select a column first');
            return;
        }

        const tableHtml = $('#product-table-preview-container').html();
        if (!tableHtml) {
            showErrorMessage('Please configure the product table first');
            return;
        }

        const elementId = `element-${elementIdCounter++}`;
        const element = $(`
                <div class="element-wrapper animate__animated animate__fadeInUp" data-element-id="${elementId}" data-element-type="product-table" style="position: relative; margin: 5px 0px;  transition: all 0.3s ease;">
                        <div class="element-actions" style="position: absolute; top: -5px; right: -5px; display: flex; gap: 5px; opacity: 0; transition: opacity 0.3s ease; z-index: 100;">
                        <button type="button" class="edit-table-content" data-tooltip="Edit Table"><i class="fas fa-edit"></i></button>
                        <button type="button" class="delete-element" data-tooltip="Delete Table"><i class="fas fa-trash"></i></button>
                        <div class="element-handle" data-tooltip="Drag to Move"><i class="fas fa-grip-vertical"></i></div>
                    </div>
                    ${tableHtml}
                </div>
            `);

        col.find('.col-placeholder-text').hide();
        col.append(element);
        makeElementRemovableAndSortable(col, element);
        makeElementResizable(element);

        $('#addElementsModal').modal('hide');
        showSuccessMessage('Product table added successfully!');
    });

    // Table Edit Functionality
    $(document).on('click', '.edit-table-content', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const element = $(this).closest('.element-wrapper');
        const table = element.find('table').clone();

        // Make all cells editable and add delete buttons
        table.find('tbody tr').each(function (index) {
            const $row = $(this);
            if (!$row.find('.delete-row-cell').length) {
                $row.append(`<td class="delete-row-cell" style="width: 50px;min-width: 50px;"><button type="button" class="delete-row-btn" data-row="${index}" title="Delete Row"><i class="fas fa-trash"></i></button></td>`);
            }
            $row.find('td:not(.delete-row-cell, .checkbox-cell), th').each(function () {
                const cell = $(this);
                const content = cell.html();
                cell.html(`<textarea class="table-cell-edit">${content}</textarea>`);
            });
        });

        $('#table-edit-container').html(table);
        $('#tableEditModal').modal('show');

        // Store reference to original element
        $('#tableEditModal').data('original-element', element);

        // Attach delete row handlers for the edit modal
        attachDeleteRowHandlers('#table-edit-container');
    });

    // Save Table Changes
    $(document).on('click', '#save-table-changes', function () {
        const originalElement = $('#tableEditModal').data('original-element');
        if (!originalElement) return;

        const editedTable = $('#table-edit-container table').clone();

        // Convert textareas back to cell content and remove delete buttons
        editedTable.find('.table-cell-edit').each(function () {
            const textarea = $(this);
            const cell = textarea.parent();
            cell.html(textarea.val());
        });
        editedTable.find('.delete-row-cell').remove();

        // Update original table
        originalElement.find('table').replaceWith(editedTable);
        makeElementResizable(originalElement);

        $('#tableEditModal').modal('hide');
        showSuccessMessage('Table updated successfully!');
    });
    // Fix image centering in columns
    function fixImageCentering() {
        $('.col').each(function () {
            const col = $(this);
            const textAlign = col.css('text-align');
            const justifyContent = col.css('justify-content');

            if (textAlign === 'center' || justifyContent === 'center') {
                col.find('.element-wrapper img, .draggable-image').css({
                    'margin': '0 auto',
                    'display': 'block'
                });
            }
        });
    }

    // Apply image centering when column settings change
    $(document).on('click', '#apply-column-settings', function () {
        setTimeout(fixImageCentering, 100);
    });

    // Initialize product table preview
    setTimeout(() => {
        if ($('#product-table-form').length) {
            generateProductTablePreview();
        }
    }, 500);

    // Image Action Button Handlers
    $(document).on('click', '.move-image', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const img = $(this).closest('.image-element-wrapper').find('.draggable-image');
        img.addClass('selected');
        showSuccessMessage('Click and drag the image to move it around');

        setTimeout(() => {
            img.removeClass('selected');
        }, 3000);
    });

    $(document).on('click', '.resize-image', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const img = $(this).closest('.image-element-wrapper').find('.draggable-image');
        const currentWidth = img.width();
        const currentHeight = img.height();

        // Simple resize dialog
        const newWidth = prompt(`Enter new width (current: ${currentWidth}px):`, currentWidth);
        if (newWidth && !isNaN(newWidth)) {
            const aspectRatio = currentHeight / currentWidth;
            const newHeight = Math.round(newWidth * aspectRatio);

            img.css({
                'width': newWidth + 'px',
                'height': newHeight + 'px'
            });

            showSuccessMessage(`Image resized to ${newWidth}x${newHeight}px`);
        }
    });
    $(document).on('click', '.delete-image', function (e) {
        e.preventDefault();
        e.stopPropagation();

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete this image?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const element = $(this).closest('.element-wrapper');
                element.addClass('animate__animated animate__fadeOut');

                setTimeout(() => {
                    element.remove();
                    showSuccessMessage('Image deleted successfully');
                }, 300);
            }
        });
    });

    // Enhanced reset forms to include new image options
    function resetImageForm() {
        $('#image-upload').val('');
        $('#image-preview').hide();
        $('#image-info').hide();
    }

    // Update the main reset function
    const originalResetElementForms = resetElementForms;
    resetElementForms = function () {
        originalResetElementForms();
        resetImageForm();
    };





    // START


    // Default proposal theme box click
    $(document).on('click', '.default_proposal_them_box', function () {
        const themeId = $(this).closest('.proposal-card').attr('id');
        const themeName = $(this).closest('.proposal-card').find('.proposal-title').text();
        themeType = $(this).find('.proposal_them_box').html();
        showLoading();
        $(this).closest('.proposal-card').addClass('animate__animated animate__pulse');
        setTimeout(() => {
            $('#page_template').val(themeId);

            $('#pages').html(`<div class="page selected animate__animated animate__fadeIn" id="page-1" data-page-id="1" style="background: #fff; box-shadow:  0 2px 10px rgba(0, 0, 0, 0.1); width: 800px;height: 1000px; margin: 0 auto 30px; position: relative; overflow: hidden;  cursor: pointer;  transition: all 0.3s ease;">
                                            <div class="page_content" style="height: 100%;  position: relative;z-index: 1;"><div class="theme_type_box">${themeType}</div></div>
                                            <button type="button" class="btn btn-remove-page btn-sm" title="Remove Page" data-page-id="3" style="position: absolute; top: 10px; right: 10px; z-index: 10;opacity: 0;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>`);
            addApplyLayoutButton($('#page-1'));
            showSuccessMessage(`${themeName} theme selected successfully!`);
            hideLoading();
            $('.theme-selection').fadeOut(300, function () {
                $('.customize-proposal').fadeIn(300);
            });
            hideLoading();
        }, 1000);
    });

    // Dynamic proposal theme box click
    $(document).on('click', '.dynamic_proposal_them_box', function () {
        const proposalId = $(this).closest('.proposal-card').data('proposal-id');
        const proposalName = $(this).closest('.proposal-card').find('.proposal-title').text();
        showLoading();
        $(this).closest('.proposal-card').addClass('animate__animated animate__pulse');
        $.ajax({
            url: `${baseurl}/customize_proposals_edit/${proposalId}/`,
            type: 'GET',
            success: function (response) {
                let updatedDescription = response.description;
                Object.keys(response.variables).forEach(key => {
                    const placeholder = `%{${key}}%`;
                    const value = response.variables[key];
                    const regex = new RegExp(placeholder, "g");
                    updatedDescription = updatedDescription.replace(regex, value);
                });
                // Destroy existing resizable instances
                $('#pages').find('.element-wrapper').each(function () {
                    if ($(this).data('ui-resizable')) {
                        try {
                            $(this).resizable('destroy');
                        } catch (e) {
                            console.warn('Error destroying resizable on element:', e.message);
                        }
                    }
                });
                $('#proposal_id').val(response.proposals.id);
                $('.proposals_name').val(response.proposals.name);
                $('#pages').html(updatedDescription);
                $('.edit_preview').val(response.proposals.preview_image_screenshoot);
                $('#page_template').val(response.proposals.page_template);
                $('.edit_screenshot').val(response.proposals.screen_shot);
                $('.theme-selection').fadeOut(300, function () {
                    $('.customize-proposal').fadeIn(300);
                });
                $('#pages .page').removeClass('selected');
                $('#page-1').addClass('selected');
                addApplyLayoutButton($('#page-1'));
                initializeSortableResizable($('.page'));
                makeElementsDraggable($('.page'));
                showSuccessMessage(`${proposalName} loaded successfully!`);
                hideLoading();
                themeType = $('#pages .page .theme_type_box').html();
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                showErrorMessage('Failed to load proposal. Please try again.');
                hideLoading();
            }
        });
    });

    // Remove proposal box
    $(document).on('click', '.remove-proposal-box', function () {
        const proposalId = $(this).data('id');
        Swal.fire({
            title: 'Confirm Deletion',
            text: 'Are you sure you want to delete this proposal?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            background: '#f0f0f0',
            customClass: {
                popup: 'custom-popup',
                title: 'custom-title'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    // url: "{{ url('customize_proposals_delete') }}/" + proposalId,
                    url: `${baseurl}/customize_proposals_delete/${proposalId}`,
                    type: 'DELETE',
                    data: {
                        proposalId: proposalId
                    },
                    success: function (response) {
                        $(`#proposal-${proposalId}`).remove();
                        Swal.fire({
                            title: 'Success',
                            text: 'Proposal deleted successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            background: '#f0f0f0',
                            customClass: {
                                popup: 'custom-popup',
                                title: 'custom-title'
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to delete proposal. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            background: '#f0f0f0',
                            customClass: {
                                popup: 'custom-popup',
                                title: 'custom-title'
                            }
                        });
                    }
                });
            }
        });
    });

    // Duplicate proposal box
    $(document).on('click', '.duplicate-proposal-box', function () {
        const $this = $(this);
        const proposalId = $this.closest('.proposal-card').data('proposal-id');
        $this.prop('disabled', true);

        $.ajax({
            // url: "{{ url('customize_proposals_duplicate') }}/" + proposalId,
            url: `${baseurl}/customize_proposals_duplicate/${proposalId}`,
            type: 'POST',
            data: {
                proposalId: proposalId
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire("Duplicated!", "The proposal has been duplicated.", "success");

                    const newProposal = response.proposal;
                    const newProposalCard = `
                        <div class="proposal-card" id="proposal-${newProposal.id}" data-proposal-id="${newProposal.id}" data-order-index="${newProposal.order_index}">
                            <div class="proposal_them_box">
                                <div class="proposal_them_img_box">
                                    ${newProposal.screen_shot ? `<img src="{{ asset('website') }}/${newProposal.screen_shot}" loading="lazy" alt="Proposal Screenshot">` : ''}
                                </div>
                            </div>
                            <h6 class="proposal-title">${newProposal.name || 'Not Available'}</h6>
                            <div class="proposal_box_btns">
                                <button type="button" class="btn remove-proposal-box" data-id="${newProposal.id}" aria-label="Remove">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn edit-proposal-box dynamic_proposal_them_box" type="button" aria-label="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button type="button" class="btn duplicate-proposal-box" data-id="${newProposal.id}" aria-label="Duplicate">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    $('.proposal-template-options').append(newProposalCard);
                    $(".proposal-template-options").sortable("refresh");
                    $('.proposal-template-options .proposal-card').css({
                        cursor: "move"
                    });
                } else {
                    Swal.fire("Error!", response.message || "Failed to duplicate the proposal.", "error");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to duplicate proposal. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    background: '#f0f0f0',
                    customClass: {
                        popup: 'custom-popup',
                        title: 'custom-title'
                    }
                }).then(() => {
                    $this.prop('disabled', false);
                });
            }
        });
    });

    // Proposal order update
    var proposalTemplateId = $('.proposal-template-options').data('id')
    $(".proposal-template-options").sortable({
        items: ".proposal-card",
        cursor: "move",
        update: function (event, ui) {
            const newOrder = $(this).sortable("toArray", { attribute: 'data-proposal-id' });
            $.ajax({
                // url: "{{ route('update_proposal_order', ['id' => $id]) }}",
                url: `${baseurl}/update_proposal_order/${proposalTemplateId}`,
                method: "POST",
                data: {
                    order: newOrder
                },
                success: function (response) {
                    console.log("Order updated successfully", response);
                },
                error: function (xhr, status, error) {
                    console.error("Error updating order:", error);
                }
            });
        }
    });

    // Add & Remove page
    $('#addPage').click(function () {
        pageCount = $('#pages .page').length;

        pageCount++;
        const newPage = $(`
                <div class="page animate__animated animate__fadeInUp" id="page-${pageCount}" data-page-id="${pageCount}" style="background: #fff; box-shadow:  0 2px 10px rgba(0, 0, 0, 0.1); width: 800px;height: 1000px; margin: 0 auto 30px; position: relative; overflow: hidden;  cursor: pointer;  transition: all 0.3s ease;">
                    <div class="page_content" style="height: 100%;  position: relative;z-index: 1;" ><div class="theme_type_box">${themeType}</div></div>
                    <button type="button" class="btn btn-remove-page btn-sm" title="Remove Page" data-page-id="3" style="position: absolute; top: 10px; right: 10px; z-index: 10;opacity: 0;">   <i class="fas fa-trash"></i> </button>
                </div>
            `);
        addApplyLayoutButton(newPage);
        $('#pages').append(newPage);
        enableLayoutSortable(newPage);
        makeElementsResizable(newPage);
        $('#pages .page').removeClass('selected');
        newPage.addClass('selected');

        showSuccessMessage(`Page ${pageCount} added successfully!`);

        // Scroll to new page
        newPage[0].scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    });
    $(document).on('click', '.btn-remove-page', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $page = $(this).closest('.page'); // Select the parent .page element
        const pageId = $page.data('page-id'); // Get pageId for the title
        const pageTitle = `Page ${pageId}`; // Adjust if you have a specific page title

        if ($page.length === 0) {
            console.error(`Page not found for button click.`);
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to delete ${pageTitle}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Remove the page from the DOM
                $page.remove();
                // Update IDs and data-page-id for remaining pages
                $('#pages .page').each(function (index) {
                    const newId = index + 1;
                    $(this).attr('id', `page-${newId}`);
                    $(this).data('page-id', newId); // Update data attribute
                    $(this).attr('data-page-id', newId); // Update HTML attribute
                    // Update the button's data-page-id
                    $(this).find('.btn-remove-page').attr('data-page-id', newId);
                });
                // Update global pageCount variable
                // Show success message with SweetAlert
                Swal.fire({
                    title: 'Deleted!',
                    text: `${pageTitle} has been deleted successfully.`,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                // Alternatively, use your existing showSuccessMessage:
                // showSuccessMessage(`${pageTitle} deleted successfully!`);
            }
        });
    });

    // Attach PDF
    $(document).on('click', '.add_attach_pdf', function () {
        $('#addAttachPdfModal').modal('show');
        // Add animation to modal
        setTimeout(() => {
            $('#addAttachPdfModal .modal-dialog').addClass('animate__animated animate__zoomIn');
        }, 100);
    });
    document.getElementById('upload-pdf-pages').addEventListener('click', function () {
        var This = $(this);

        This.attr('disabled', true);
        const file = document.getElementById('pdf-file-input').files[0];
        if (!file) {
            showErrorMessage('Please select a PDF file first');
            return;
        }

        // Get selected pages
        const selectedCheckboxes = document.querySelectorAll('.page-checkbox:checked');
        if (selectedCheckboxes.length === 0) {
            showErrorMessage('Please select at least one page to upload');
            return;
        }

        const selectedPages = Array.from(selectedCheckboxes).map(cb => parseInt(cb.dataset.page));
        console.log('Selected pages:', selectedPages);

        showLoading();

        // Get the current page count from existing pages
        const existingPageCount = document.querySelectorAll('.page').length;

        const reader = new FileReader();
        reader.onload = function (e) {
            const arrayBuffer = e.target.result;
            const pdf = pdfjsLib.getDocument({
                data: arrayBuffer
            });

            pdf.promise.then(async function (pdfDoc) {
                let uploadedCount = 0;

                // Upload only selected pages in order
                for (let i = 0; i < selectedPages.length; i++) {
                    const pageNumber = selectedPages[i];
                    const pageIndex = existingPageCount + i + 1; // Sequential index for uploaded pages

                    try {
                        await addNewPageWithPDFContent(file.name, pageNumber, pdfDoc, pageIndex);
                        uploadedCount++;
                        console.log(`Uploaded page ${pageNumber} (${uploadedCount}/${selectedPages.length})`);
                    } catch (error) {
                        console.error(`Error uploading page ${pageNumber}:`, error);
                    }
                }

                hideLoading();
                showSuccessMessage(`${uploadedCount} PDF pages added to proposal!`);
                $('#addAttachPdfModal').modal('hide');
                $('#pdf-file-input').val('');
                $('#pdf-preview-container').hide();
                $('#pdf-pages-preview').empty();
                This.attr('disabled', false);
            });
        };
        reader.readAsArrayBuffer(file);
    });
    function addNewPageWithPDFContent(fileName, pageNumber, pdf, pageIndex) {
        return new Promise((resolve, reject) => {
            // Get the page from the PDF document
            pdf.getPage(pageNumber).then(function (page) {
                const scale = 2.5; // Increase scale for better image quality
                const viewport = page.getViewport({
                    scale: scale
                });

                // Create a canvas to render the PDF page
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render the page to the canvas
                page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise.then(function () {
                    // Convert canvas to image
                    const img = new Image();
                    img.src = canvas.toDataURL('image/webp'); // Convert canvas to image source (PNG format)

                    // Prepare FormData for AJAX request
                    const formData = new FormData();
                    // formData.append('_token', '{{ csrf_token() }}'); // CSRF token for Laravel
                    formData.append('_token', csrfToken);
                    // Convert canvas data URL to a Blob for file upload
                    canvas.toBlob(function (blob) {
                        formData.append('image', blob, `page-${pageIndex}.png`); // Append image as a file

                        showLoading();

                        // Send AJAX request to save the image
                        $.ajax({
                            url: `${baseurl}/upload_proposal_image`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                console.log('Image saved successfully:', response);

                                // Create the new page element
                                const newPage = document.createElement('div');
                                newPage.classList.add('page', 'animate__animated', 'animate__fadeInUp');
                                newPage.id = `page-${pageIndex}`; // Use pageIndex to correctly set the ID
                                newPage.dataset.pageId = pageIndex; // Correct data-page-id attribute
                                newPage.style = 'background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 800px; height: 1000px; margin: 0 auto 30px; position: relative; overflow: hidden; cursor: pointer; transition: all 0.3s ease;';

                                const deleteButton = document.createElement('button');
                                deleteButton.type = 'button';
                                deleteButton.classList.add('btn', 'btn-remove-page', 'btn-sm');
                                deleteButton.title = 'Remove Page';
                                deleteButton.dataset.pageId = pageIndex;
                                deleteButton.style = 'position: absolute; top: 10px; right: 10px; z-index: 10; opacity: 1;'; // Make button visible
                                deleteButton.innerHTML = '<i class="fas fa-trash"></i>';


                                const pageContent = document.createElement('div');
                                pageContent.className = 'page_content';
                                pageContent.style = 'height: 100%;';

                                // Create a container for the PDF image
                                const pdfImageContainer = document.createElement('div');
                                pdfImageContainer.className = 'pdf-page-image-container';
                                pdfImageContainer.style = 'width: 100%; height: 100%; position: relative;';

                                // Use the image URL from the response (if the server returns it) or fallback to canvas data
                                img.src = response.imagePath || img.src; // Assuming the server returns the saved image URL
                                img.style = 'width: 100%; height: auto; max-height: 100%; object-fit: contain;object-position: top; display: block; margin: 0 auto;';

                                // Append the image to the container
                                pdfImageContainer.appendChild(img);
                                pageContent.appendChild(pdfImageContainer);
                                newPage.appendChild(pageContent);
                                newPage.appendChild(deleteButton);
                                // Append the new page to the document
                                document.getElementById('pages').appendChild(newPage);

                                resolve(response);
                                hideLoading();

                            },
                            error: function (xhr, status, error) {
                                console.error('Error saving image:', error);
                                reject(error);
                            }
                        });
                    }, 'image/png');
                }).catch(reject);
            }).catch(reject);
        });
    }

    //  Reorder Pages
    function populatePageReorderModal() {
        const container = $('#pageReorderContainer');
        if (!container.length) {
            console.error('Container #pageReorderContainer not found in the DOM.');
            return;
        }
        container.empty(); // Clear existing content

        // Show loading indicator
        container.html('<div class="text-center p-4"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading page previews...</p></div>');

        const pageCards = []; // Array to store page cards
        const promises = []; // Array to store all promises

        // Get all pages from #pages container and sort by data-page-id
        const $pages = $('#pages .page').toArray().sort((a, b) => {
            const idA = parseInt($(a).data('page-id')) || $(a).index() + 1;
            const idB = parseInt($(b).data('page-id')) || $(b).index() + 1;
            return idA - idB;
        });

        $pages.forEach(($page, index) => {
            const pageId = $page.id.replace('page-', '');
            const pageName = `Page ${pageId}`;

            console.log('Processing:', {
                index: index + 1,
                pageId,
                pageName
            });

            // Clone and prepare page for html2canvas
            const $pageClone = $($page).clone()
                .css({
                    display: 'block',
                    visibility: 'visible',
                    position: 'absolute',
                    left: '-9999px',
                    top: '-9999px',
                    width: '800px',
                    height: '1000px'
                })
                .appendTo('body');

            // Remove interactive elements that might interfere with screenshot
            $pageClone.find('.layout-actions, .col-actions, .element-actions, .ui-resizable-handle, .btn-remove-page')
                .remove();

            // Create promise for this page's screenshot
            const promise = html2canvas($pageClone[0], {
                scale: 0.3, // Reduced scale for performance and smaller thumbnails
                backgroundColor: '#ffffff',
                useCORS: true,
                logging: false,
                width: 800,
                height: 1000,
                windowWidth: 800,
                windowHeight: 1000
            }).then(canvas => {
                $pageClone.remove(); // Clean up
                const screenshotUrl = canvas.toDataURL('image/webp', 0.8);

                const pageCard = $(`
                <div class="page-card" data-page-id="${pageId}" data-original-index="${index}" style="margin: 10px; padding: 15px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: move;">
                    <div class="d-flex align-items-center flex-column">
                        <div class="drag-handle mb-2" style="color: #666; cursor: grab;">
                            <i class="fas fa-grip-vertical fa-lg"></i>
                        </div>
                        <div class="page-screenshot mb-2" style="width: 120px; height: 150px; overflow: hidden; border: 1px solid #ccc; border-radius: 4px;">
                            <img src="${screenshotUrl}" alt="Page ${pageName} screenshot" class="screenshot-img" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="page-info text-center">
                            <p class="mb-0"><strong>${pageName}</strong></p>
                            <small class="text-muted">Position: <span class="page-index">${index + 1}</span></small>
                        </div>
                    </div>
                </div>
            `);

                pageCards[index] = pageCard; // Store in array at correct index
                return pageCard;
            }).catch(err => {
                $pageClone.remove(); // Clean up
                console.error(`Failed to generate screenshot for page ${pageId}:`, err);

                // Create fallback card without screenshot
                const pageCard = $(`
                <div class="page-card" data-page-id="${pageId}" data-original-index="${index}" style="margin: 10px; padding: 15px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: move;">
                    <div class="d-flex align-items-center flex-column">
                        <div class="drag-handle mb-2" style="color: #666; cursor: grab;">
                            <i class="fas fa-grip-vertical fa-lg"></i>
                        </div>
                        <div class="page-screenshot mb-2" style="width: 120px; height: 150px; overflow: hidden; border: 1px solid #ccc; border-radius: 4px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                            <i class="fas fa-file-alt fa-3x text-muted"></i>
                        </div>
                        <div class="page-info text-center">
                            <p class="mb-0"><strong>${pageName}</strong></p>
                            <small class="text-muted">Position: <span class="page-index">${index + 1}</span></small>
                        </div>
                    </div>
                </div>
            `);

                pageCards[index] = pageCard; // Store in array at correct index
                return pageCard;
            });

            promises.push(promise);
        });

        // Wait for all promises to resolve, then append all cards in order
        Promise.all(promises).then(results => {
            container.empty(); // Remove loading indicator

            // Append cards in correct order
            pageCards.forEach(card => {
                if (card) {
                    container.append(card);
                }
            });

            // Initialize sortable functionality
            initializePageSortable();

            showSuccessMessage(`${pageCards.length} pages loaded successfully!`);
        }).catch(err => {
            console.error('Error loading page previews:', err);
            container.html('<div class="text-center p-4 text-danger"><i class="fas fa-exclamation-triangle fa-2x"></i><p class="mt-2">Failed to load page previews</p></div>');
            showErrorMessage('Failed to load page previews');
        });
    }
    function initializePageSortable() {
        if (!$.fn.sortable) {
            console.error('jQuery UI Sortable is not loaded. Please ensure jQuery UI is included.');
            return;
        }

        const $container = $('#pageReorderContainer');
        if (!$container.length) {
            console.error('Container #pageReorderContainer not found in the DOM.');
            return;
        }

        // Destroy existing sortable if it exists
        if ($container.data('ui-sortable')) {
            $container.sortable('destroy');
        }

        $container.sortable({
            items: '.page-card',
            handle: '.drag-handle',
            placeholder: 'page-card-placeholder',
            cursor: 'grabbing',
            tolerance: 'intersect',
            opacity: 0.8,
            forcePlaceholderSize: true,
            helper: 'clone',
            start: function (event, ui) {
                ui.helper.addClass('dragging').css({
                    'transform': 'rotate(5deg)',
                    'box-shadow': '0 8px 25px rgba(0,0,0,0.3)',
                    'z-index': 1000
                });

                // Style placeholder
                ui.placeholder.css({
                    'background': 'linear-gradient(45deg, rgba(0,123,255,0.1) 25%, transparent 25%, transparent 75%, rgba(0,123,255,0.1) 75%)',
                    'background-size': '20px 20px',
                    'border': '2px dashed #007bff',
                    'border-radius': '8px',
                    'height': ui.helper.outerHeight(),
                    'width': ui.helper.outerWidth()
                });

                showSuccessMessage('Drag to reorder pages');
            },
            sort: function (event, ui) {
                // Add animation to placeholder
                ui.placeholder.addClass('animate__animated animate__pulse');
            },
            stop: function (event, ui) {
                ui.item.removeClass('dragging').css({
                    'transform': 'none',
                    'box-shadow': 'none'
                });

                updatePageIndices();
                showSuccessMessage('Page order changed - remember to save!');
            }
        });

        // Add hover effects for better UX
        $container.find('.drag-handle').hover(
            function () {
                $(this).css({
                    'color': '#007bff',
                    'transform': 'scale(1.1)'
                });
            },
            function () {
                $(this).css({
                    'color': '#666',
                    'transform': 'scale(1)'
                });
            }
        );
    }
    function updatePageIndices() {
        $('#pageReorderContainer .page-card').each(function (index) {
            $(this).find('.page-index').text(index + 1);
        });
    }
    $(document).on('click', '#openPageReorderBtn', function () {
        const totalPages = $('#pages .page').length;

        if (totalPages === 0) {
            Swal.fire({
                title: 'No Pages Found',
                text: 'Please add some pages to your proposal first.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
            return;
        }

        $('#pageReorderModal').modal('show');

        // Populate modal after it's shown to ensure proper rendering
        $('#pageReorderModal').on('shown.bs.modal', function () {
            populatePageReorderModal();
            $(this).off('shown.bs.modal'); // Remove event listener after first use
        });
    });
    $(document).on('click', '#savePageOrder', function () {
        const $saveBtn = $(this);
        const originalText = $saveBtn.html();
        $saveBtn.html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
        const newOrder = [];
        const reorderedPageIds = [];
        $('#pageReorderContainer .page-card').each(function (index) {
            const pageId = $(this).data('page-id');
            newOrder.push({
                pageId: pageId,
                newIndex: index + 1,
                originalIndex: $(this).data('original-index')
            });
            reorderedPageIds.push(pageId);
        });
        setTimeout(() => {
            const $pagesContainer = $('#pages');
            const $allPages = $pagesContainer.find('.page').detach();
            reorderedPageIds.forEach((pageId, newIndex) => {
                let $page = $allPages.filter(`[data-page-id="${pageId}"]`).first();
                if ($page.length === 0) {
                    $page = $allPages.filter(`#page-${pageId}`).first();
                }
                if ($page.length > 0) {
                    $page.attr('data-page-id', newIndex + 1);
                    $page.attr('id', `page-${newIndex + 1}`);
                    $page.find('.btn-remove-page').attr('data-page-id', newIndex + 1);
                    $pagesContainer.append($page);
                }
            });
            pageCount = reorderedPageIds.length;
            $saveBtn.html(originalText).prop('disabled', false);
            Swal.fire({
                title: 'Success!',
                text: 'Pages reordered successfully!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
            $('#pageReorderModal').modal('hide');
            console.log('New page order applied:', newOrder);
        }, 800);
    });

    // Preview Modal
    let currentPreviewPage = 1;
    let totalPreviewPages = 1;
    $(document).on('click', '#fullPreviewBtn', function () {
        showFullPreview();
    });
    function showFullPreview() {
        const pages = $('#pages .page');
        const previewContainer = $('#previewContainer');
        previewContainer.empty();
        totalPreviewPages = pages.length;
        $('#totalPagesNum').text(totalPreviewPages);
        pages.each(function (index) {
            const page = $(this);
            const pageClone = page.clone();
            pageClone.find('.element-actions, .col-actions, .layout-actions, .ui-resizable-handle').remove();
            pageClone.find('.element-wrapper').removeClass('ui-resizable ui-sortable');
            pageClone.find('.col').removeClass('ui-resizable ui-sortable');
            pageClone.find('.layout-row, .layout-col').removeClass('ui-sortable');
            pageClone.find('.element-wrapper').css({
                'border': 'none',
                'background': 'transparent',
                'padding': '0',
                'margin': '0'
            });
            pageClone.addClass('preview-page');
            pageClone.attr('data-preview-page', index + 1);

            if (index === 0) {
                pageClone.show();
            } else {
                pageClone.hide();
            }
            previewContainer.append(pageClone);
        });
        currentPreviewPage = 1;
        updatePreviewNavigation();
        $('#fullPreviewModal').modal('show');
    }
    $(document).on('click', '#prevPage', function () {
        if (currentPreviewPage > 1) {
            currentPreviewPage--;
            showPreviewPage(currentPreviewPage);
        }
    });
    $(document).on('click', '#nextPage', function () {
        if (currentPreviewPage < totalPreviewPages) {
            currentPreviewPage++;
            showPreviewPage(currentPreviewPage);
        }
    });
    function showPreviewPage(pageNum) {
        $('.preview-page').hide();
        $(`.preview-page[data-preview-page="${pageNum}"]`).show();
        updatePreviewNavigation();
    }
    function updatePreviewNavigation() {
        $('#currentPageNum').text(currentPreviewPage);
        $('#prevPage').prop('disabled', currentPreviewPage === 1);
        $('#nextPage').prop('disabled', currentPreviewPage === totalPreviewPages);
    }
    $(document).on('keydown', function (e) {
        if ($('#fullPreviewModal').hasClass('show')) {
            if (e.key === 'ArrowLeft' && currentPreviewPage > 1) {
                currentPreviewPage--;
                showPreviewPage(currentPreviewPage);
            } else if (e.key === 'ArrowRight' && currentPreviewPage < totalPreviewPages) {
                currentPreviewPage++;
                showPreviewPage(currentPreviewPage);
            } else if (e.key === 'Escape') {
                $('#fullPreviewModal').modal('hide');
            }
        }
    });


});