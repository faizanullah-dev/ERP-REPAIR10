<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f5f5f5;">
@php $data = App\EmailBranding::first(); @endphp
<div style="max-width: 600px; background: #ffffff; display: flex; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); margin: 20px auto;">
    <!-- Logo Section -->
    <div style="background: {{$data->logo_background??'#1b365d'}}; padding: 20px; display: flex; align-items: {{$data->logo_alignment??'center'}}; justify-content: {{$data->logo_position??'center'}}; flex-direction: column; width: 35%;">
        <img src="{{ asset('website/images/' . ($data->logo ?? 'img.png')) }}" alt="Profile Image" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #ffffff; object-fit: contain; margin-bottom: 15px;">
    </div>

    <!-- Content Section -->
    <div style="padding: 20px; width: 65%; display: flex; flex-direction: column; justify-content: center;">
        <div style="font-size: 22px; font-weight: bold; color: #000; margin-bottom: 8px;">{{$data->name??''}}</div>
        <div style="color: #0073b1; font-size: 16px; line-height: 25px; margin-bottom: 20px;">{{$data->description??''}}</div>

        <!-- Contact Information -->
        <div style="font-size: 14px; color: #555; margin: 5px 0;">
            <span style="color: #0073b1; font-weight: bold; margin-right: 5px;">&#9742;</span>
            {{$data->phone??''}}
        </div>

        <div style="font-size: 14px; color: #555; margin: 5px 0;">
            <span style="color: #0073b1; font-weight: bold; margin-right: 5px;">&#9993;</span>
            <a href="mailto:{{$data->email??'#'}}" style="color: #0073b1; text-decoration: none;">{{$data->email??''}}</a>
        </div>

        <div style="font-size: 14px; color: #555; margin: 5px 0;">
            <span style="color: #0073b1; font-weight: bold; margin-right: 5px;">&#127760;</span>
            <a href="{{$data->website??'#'}}" style="color: #0073b1; text-decoration: none;">{{$data->website??''}}</a>
        </div>

        <div style="font-size: 14px; color: #555; margin: 5px 0;">
            <span style="color: #0073b1; font-weight: bold; margin-right: 5px;">&#128205;</span>
            {{$data->address??''}}
        </div>

        <!-- Social Media Links -->
        <div style="margin-top: 20px; display: flex; gap: 10px; align-items: center;">
            <!-- Facebook Icon -->
            <a href="{{$data->social_link_one??'#'}}" style="color: #1b365d; text-decoration: none;">
                <div style="width: 32px; height: 32px; display: flex; justify-content: center; align-items: center; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 50%;">
                    <img src="{{asset('website')}}/images/fb.png" style="width: 18px; height: 18px; object-fit: contain;">
                </div>
            </a>

            <!-- Twitter/X Icon -->
            <a href="{{$data->social_link_two??'#'}}" style="color: #1b365d; text-decoration: none;">
                <div style="width: 32px; height: 32px; display: flex; justify-content: center; align-items: center; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 50%;">
                    <img src="{{asset('website')}}/images/linkedin.png" style="width: 18px; height: 18px; object-fit: contain;">
                </div>
            </a>

            <!-- LinkedIn Icon -->
            <a href="{{$data->social_link_three??'#'}}" style="color: #1b365d; text-decoration: none;">
                <div style="width: 32px; height: 32px; display: flex; justify-content: center; align-items: center; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 50%;">
                    <img src="{{asset('website')}}/images/twitter.png" style="width: 18px; height: 18px; object-fit: contain;">
                </div>
            </a>

            <!-- Instagram Icon -->
            <a href="{{$data->social_link_four??'#'}}" style="color: #1b365d; text-decoration: none;">
                <div style="width: 32px; height: 32px; display: flex; justify-content: center; align-items: center;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 50%;">
                    <img src="{{asset('website')}}/images/insta.jpg" style="width: 18px; height: 18px; object-fit: contain;">
                </div>
            </a>
        </div>
    </div>
</div>
</body>
