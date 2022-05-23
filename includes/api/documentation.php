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
            <h1>Quit Smkoking API Endpoints</h1>
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

    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Get smoke data</h4></legend>
        <p><strong>Endpoint:</strong><code> /wp-json/qs-progress/v1.0/smoke-free </code><p>
        <p><strong>Method:</strong><code> GET </code><p>
        <p><strong>Param:</strong><code> None    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "id": "7",
    "user_id": "1",
    "quit_date": "2014-05-03 06:58:00",
    "date_format": "j F Y",
    "cig_per_day": "56",
    "cig_pack_price": "562.00",
    "currency": "ALL",
    "first_cig_after_wakeup": "",
    "created_on": "2020-11-11 13:56:32",
    "updated_on": "2020-11-11 13:59:51"
}</code></pre>
    </fieldset>

    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Add quit date</h4></legend>
        <p><strong>Endpoint:</strong><code> /wp-json/qs-progress/v1.0/smoke-free/quit-date </code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Param:</strong><code> {"date_format": "j F Y","quit_date":"2020-05-03 06:58:00"}    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "message": "Successfully updated Quit date",
    "data": {
        "id": "7",
        "user_id": "1",
        "quit_date": "2020-05-03 06:58:00",
        "date_format": "j F Y",
        "cig_per_day": "56",
        "cig_pack_price": "562.00",
        "currency": "ALL",
        "first_cig_after_wakeup": "",
        "created_on": "2020-11-11 13:56:32",
        "updated_on": "2020-11-13 14:08:14"
    }
}</code></pre>
    </fieldset>

    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Add Cigarette Per Day</h4></legend>
        <p><strong>Endpoint:</strong><code> /wp-json/qs-progress/v1.0/smoke-free/cigarette-per-day </code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Param:</strong><code> {"cigarettes_per_day": "2"}    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "message": "Successfully updated Quit date",
    "data": {
        "id": "7",
        "user_id": "1",
        "quit_date": "2020-05-03 06:58:00",
        "date_format": "j F Y",
        "cig_per_day": "2",
        "cig_pack_price": "562.00",
        "currency": "ALL",
        "first_cig_after_wakeup": "",
        "created_on": "2020-11-11 13:56:32",
        "updated_on": "2020-11-13 15:57:54"
    }
}
}</code></pre>
    </fieldset>

    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Add Cigarette Price</h4></legend>
        <p><strong>Endpoint:</strong><code> /wp-json/qs-progress/v1.0/smoke-free/cigarette-price </code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Param:</strong><code> {"cigarette_price": "50","currency":"USD"}    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "message": "Successfully updated Quit date",
    "data": {
        "id": "7",
        "user_id": "1",
        "quit_date": "2020-05-03 06:58:00",
        "date_format": "j F Y",
        "cig_per_day": "2",
        "cig_pack_price": "50.00",
        "currency": "USD",
        "first_cig_after_wakeup": "",
        "created_on": "2020-11-11 13:56:32",
        "updated_on": "2020-11-13 16:00:14"
    }
}</code></pre>
    </fieldset>

    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Get Smoke stats</h4></legend>
        <p><strong>Endpoint:</strong><code> /wp-json/qs-progress/v1.0/smoke-free/stats </code><p>
        <p><strong>Method:</strong><code> GET </code><p>
        <p><strong>Param:</strong><code> None    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "quit_days": 17,
    "is_future_date": false,
    "cigarette_not_smoked": {
        "cigarette": 340
    },
    "life_regained": 2,
    "not_smoked": {
        ...
        ...
    },
    "quit_time": {
        ...
        ...
    },
    "money_saved": {
        "per_day": 250,
        "money": 4250,
        "currency": "INR",
        "currency_symbol": "&#8377;"
    },
    "achievements": {
       ...
       ...
        },

    }
}</code></pre>
    </fieldset>









</div>