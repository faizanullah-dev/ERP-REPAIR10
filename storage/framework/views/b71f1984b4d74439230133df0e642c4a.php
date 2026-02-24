

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="customer_chat_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="chat_container">
                        <div class="sidebar">
                            <div class="search-container">
                                <input type="text" class="search-box" placeholder="Search chat by name" id="searchInput">
                            </div>
                            <div class="contacts-list" id="contactsList"></div>
                        </div>
                        <div class="chat-area" id="chatArea">
                            <div class="welcome-screen">
                                <i class="fas fa-comments welcome-icon"></i>
                                <h2 class="welcome-title">Lead Chat</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            const leads = <?php echo json_encode($leads, 15, 512) ?>;
            let currentContact = null;
            let selectedAttachment = null;
            let attachmentPreviewData = null;

            // Format message time
            function formatMessageTime(dateString) {
                const date = new Date(dateString);
                return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            }

            function getLatestMessageTime(lead) {
                if (lead.chat_messages.length > 0) {
                    return new Date(lead.chat_messages[lead.chat_messages.length - 1].created_at);
                }
                return new Date(0); // If no messages, use epoch time
            }

            // Transform leads data for frontend
            const contacts = leads.map(lead => {
                const lastMessage = lead.chat_messages.length > 0
                    ? lead.chat_messages[lead.chat_messages.length - 1].message
                    : 'No messages yet';

                return {
                    id: lead.id,
                    name: lead.title || `Lead #${lead.id}`,
                    lastMessage: lastMessage,
                    time: lead.chat_messages.length > 0
                        ? formatMessageTime(lead.chat_messages[lead.chat_messages.length - 1].created_at)
                        : '',
                    avatar: lead.title ? lead.title.charAt(0) : 'L',
                    messages: lead.chat_messages.map(msg => ({
                        text: msg.message,
                        sent: msg.sender_type === 'admin',
                        time: formatMessageTime(msg.created_at),
                        attachments: msg.attachments ? JSON.parse(msg.attachments) : ''
                    })),
                    lastActivity: getLatestMessageTime(lead)
                };
            }).sort((a, b) => b.lastActivity - a.lastActivity);

            // Populate contacts list with real data
            function populateContacts() {
                const contactsList = $('.contacts-list');
                contactsList.empty();

                contacts.forEach(contact => {
                    const contactElement = $(`
                <div class="contact-item" data-contact-id="${contact.id}">
                    <div class="contact-avatar" style="">
                        <span style="background-color: #74C911; color: #FFF; padding: 10px 20px; border-radius: 15px;">${contact.name.charAt(0)} </span>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">${contact.name}</div>
                        <div class="contact-last-message">${contact.lastMessage || 'Attachment'}</div>
                    </div>
                    <div class="contact-time">${contact.time}</div>
                </div>
            `);
                    contactsList.append(contactElement);
                });
            }

            // Load chat for selected lead
            function loadChat(leadId) {
                const contact = contacts.find(c => c.id === leadId);
                if (!contact) return;

                currentContact = contact;

                // Update active contact
                $('.contact-item').removeClass('active');
                $(`.contact-item[data-contact-id="${leadId}"]`).addClass('active');

                // Create chat interface
                const chatArea = $('.chat-area');
                chatArea.html(`
            <div class="chat-header">
                <div class="chat-user-info">
                    <div class="chat-user-avatar" style="">
                        <span style="background-color: #74C911; color: #FFF; padding: 10px 20px; border-radius: 15px;">${contact.name.charAt(0)} </span>
                    </div>
                    <div>
                        <div class="chat-user-name">${contact.name}</div>
                    </div>
                </div>
            </div>

            <div class="messages-container" id="messagesContainer">
                <!-- Messages will be populated here -->
            </div>

            <div class="imager_preview_attachement" id="attachmentPreview" style="">
                <a href="javascript:void(0)" class="customer_remove_icon_img">
                    <i class="fa-solid fa-xmark"></i>
                </a>
                <div class="imager_preview_attachement_inner"></div>
            </div>

            <div class="message-input-container">
                <input type="text" class="message-input" placeholder="Type a message" id="messageInput">
                <button class="attachment-btn" id="attachmentBtn">
                    <i class="fas fa-paperclip"></i>
                </button>
                <input class="attachmentInput_class" type="file" id="attachmentInput" accept=".jpg,.jpeg,.png,.pdf" hidden>
                <button class="send-btn" id="sendBtn" disabled>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        `);

                // Load messages for this lead
                loadMessages(leadId);

                // Initialize input event for new message box
                $('#messageInput').on('input', function() {
                    const text = $(this).val().trim();
                    $('#sendBtn').prop('disabled', !text && !selectedAttachment);
                });
            }

            // Load messages for lead
            function loadMessages(leadId) {
                const messagesContainer = $('#messagesContainer');
                messagesContainer.empty();

                const contact = contacts.find(c => c.id === leadId);
                if (!contact || !contact.messages) return;

                contact.messages.forEach(message => {
                    let messageContent = message.text ? `<div class="message-text">${message.text}</div>` : '';
                    let attachmentHtml = '';

                    if (message.attachments) {
                        message.attachments.forEach(attachment => {
                            if (attachment.type.startsWith('image/')) {
                                attachmentHtml += `
                            <div class="message-attachment">
                                <img src="${attachment.url}" alt="Attachment" class="attachment-image" width="200">
                            </div>`;
                            } else if (attachment.type === 'application/pdf') {
                                attachmentHtml += `
                            <div class="message-attachment">
                                <a href="${attachment.url}" target="_blank" class="pdf-attachment">
                                    <i class="fas fa-file-pdf"></i> ${attachment.name || 'PDF Document'}
                                </a>
                            </div>`;
                            }
                        });
                    }

                    const messageElement = $(`
                <div class="message ${message.sent ? 'sent' : 'received'}">
                    <div class="message-bubble">
                        ${messageContent}
                        ${attachmentHtml}
                        <div class="message-time">${message.time}</div>
                    </div>
                </div>
            `);
                    messagesContainer.append(messageElement);
                });

                // Scroll to bottom
                messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
            }

            // Send message to server
            function sendMessage(text, attachments = null) {
                if (!text && !attachments) return;
                if ((!text.trim() && !attachments) || !currentContact) return;

                const leadId = currentContact.id;
                const formData = new FormData();
                if (text) {
                    formData.append('message', text);
                }
                formData.append('lead_id', leadId);
                formData.append('type', 'lead');
                formData.append('sender_id', <?php echo e(auth()->user()->id); ?>);
                formData.append('_token', '<?php echo e(csrf_token()); ?>');

                if (attachments) {
                    for (let i = 0; i < attachments.length; i++) {
                        formData.append('attachments[]', attachments[i]);
                    }
                }

                $.ajax({
                    url: '<?php echo e(url("send_chat_message")); ?>',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Add the new message to the UI
                            const newMessage = {
                                text: text || '',
                                sent: true,
                                time: formatMessageTime(new Date()),
                                attachments: response.attachments || null
                            };

                            // Add to local data
                            const contact = contacts.find(c => c.id === leadId);
                            if (contact) {
                                contact.messages.push(newMessage);
                                contact.lastMessage = text || (response.attachments ? 'Attachment' : 'No message');
                                contact.time = formatMessageTime(new Date());

                                // Update UI
                                loadMessages(leadId);
                                populateContacts();
                                $(`.contact-item[data-contact-id="${leadId}"]`).addClass('active');
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error('Error sending message:', xhr.responseText);
                        alert('Failed to send message. Please try again.');
                    }
                });
            }

            // Attachment handling
            $(document).on('click', '#attachmentBtn', function() {
                $('#attachmentInput').click();
            });

            $(document).on('change', '#attachmentInput', function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const fileType = file.type;
                const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];

                if (!validTypes.includes(fileType)) {
                    alert("Only JPG, PNG, and PDF files are supported.");
                    selectedAttachment = null;
                    attachmentPreviewData = null;
                    $('#attachmentPreview .imager_preview_attachement_inner').html('');
                    $('#attachmentPreview').hide();
                    return;
                }

                selectedAttachment = file;

                let previewHTML = '';
                if (fileType.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        attachmentPreviewData = e.target.result;
                        previewHTML = `<img src="${e.target.result}" alt="Preview">`;
                        $('#attachmentPreview .imager_preview_attachement_inner').html(previewHTML);
                        $('#attachmentPreview').show();
                        $('#sendBtn').prop('disabled', false);
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'application/pdf') {
                    const blobUrl = URL.createObjectURL(file);
                    attachmentPreviewData = blobUrl;
                    previewHTML = `
                <div class="preview-file">
                    <i class="fas fa-file-pdf"></i>
                    <span>${file.name}</span>
                </div>`;
                    $('#attachmentPreview .imager_preview_attachement_inner').html(previewHTML);
                    $('#attachmentPreview').show();
                    $('#sendBtn').prop('disabled', false);
                }
            });

            // Handle remove attachment
            $(document).on('click', '.customer_remove_icon_img', function() {
                selectedAttachment = null;
                attachmentPreviewData = null;
                $('#attachmentInput').val('');
                $('#attachmentPreview').hide().find('.imager_preview_attachement_inner').html('');
                $('#sendBtn').prop('disabled', $('#messageInput').val().trim() === '');
            });

            // Send message when Enter key is pressed
            $(document).on('keypress', '#messageInput', function(e) {
                if (e.which === 13) { // Enter key
                    const messageText = $(this).val();
                    const attachments = selectedAttachment ? [selectedAttachment] : null;
                    sendMessage(messageText, attachments);

                    // Clear inputs
                    $(this).val('');
                    $('#attachmentInput').val('');
                    $('#attachmentPreview').hide().find('.imager_preview_attachement_inner').html('');
                    selectedAttachment = null;
                    $('#sendBtn').prop('disabled', true);
                }
            });

            // Send button click handler
            $(document).on('click', '#sendBtn', function() {
                const messageText = $('#messageInput').val();
                const attachments = selectedAttachment ? [selectedAttachment] : null;
                sendMessage(messageText, attachments);

                // Clear inputs
                $('#messageInput').val('');
                $('#attachmentInput').val('');
                $('#attachmentPreview').hide().find('.imager_preview_attachement_inner').html('');
                selectedAttachment = null;
                $(this).prop('disabled', true);
            });

            // Search functionality
            $(document).on('input', '#searchInput', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.contact-item').each(function() {
                    const contactName = $(this).find('.contact-name').text().toLowerCase();
                    if (contactName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Contact item click handler
            $(document).on('click', '.contact-item', function() {
                const leadId = parseInt($(this).data('contact-id'));
                loadChat(leadId);
            });

            // Initialize
            populateContacts();

            // Load first lead chat if available
            if (contacts.length > 0) {
                loadChat(contacts[0].id);
            }
        });
    </script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/admin/lead_chat.blade.php ENDPATH**/ ?>