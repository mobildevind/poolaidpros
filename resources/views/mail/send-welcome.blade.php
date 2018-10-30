<p style="margin: 0px; padding: 0px; font-size: 14px; font-family: Arial;">
        <p>Dear {{ $user_name }},</p>
        
        <p> Your request for registration has been processed. please check below your details.</p>
        <p>Name: {{ $user_name }}</p>
        <p>Email: {{ $email }}</p>
        <p>Mobile Number: {{ $mobile }}</p>
        <p>{{$address_type}} Address : {{ $address }}</p>
        <p>Click <a href="{{ $verifyUrl }}">here</a> to verify your email address.</p>
        <p>
        Thanks,<br>
        WeHelp App
        </p>
</p>