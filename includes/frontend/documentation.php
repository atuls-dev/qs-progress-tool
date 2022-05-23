<style type="text/css">
            .nl-esi-shadow .sec-title {
                border: 1px solid #ebebeb;
                background: #fff;
                color: #d54e21;
                padding: 2px 4px;
            }
            .nl-esi-shadow{
                border:1px solid #ebebeb; padding:5px 20px; background:#fff; margin-bottom:40px;
                -webkit-box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);
                -moz-box-shadow:    4px 4px 10px 0px rgba(50, 50, 50, 0.1);
                box-shadow:         4px 4px 10px 0px rgba(50, 50, 50, 0.1);
            }
</style>
<div class="wrap">
            <h1>Quit Smkoking Documentation</h1>
    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Authentication</h4></legend>
        <p>You need to create a bearer token or you can use <a href="https://wordpress.org/plugins/jwt-auth/">jwt-auth</a> </p>
        <p><strong>Endpoint:</strong><code> /wp-json/jwt-auth/v1/token </code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Param:</strong><code> {"username": "your-username","password":"your-password"} </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
        "token": "******************************************************",
        "user_email": "***@***.com",
        "user_nicename": "****",
        "user_display_name": "****"
}</code></pre>
    </fieldset>











</div>