<?php

/*

Step One: Direct your user to our authorization URL

https://api.instagram.com/oauth/authorize/?client_id=CLIENT-ID&redirect_uri=REDIRECT-URI&response_type=code
//Note: You may provide an optional scope parameter
 to request additional permissions outside of the “basic” permissions scope. Learn more about scope.


Step Two: Receive the redirect from Instagram

Once a user authorizes your application, we issue a redirect to your redirect_uri with a code parameter to use in step three.

http://your-redirect-uri?code=CODE



If your request for approval is denied by the user, then we will redirect the user to your redirect_uri with the following parameters:

    error: access_denied

    error_reason: user_denied

    error_description: The user denied your request

    http://your-redirect-uri?error=access_denied&error_reason=user_denied&error_description=The+user+denied+your+request

It is your responsibility to fail gracefully in this situation and display a corresponding error message to your user


Now you need to exchange the code you have received in the previous step for an access token. 
In order to make this exchange, you simply have to POST this code,
 along with some app identification parameters, to our access_token endpoint. These are the required parameters:

    client_id: your client id
    client_secret: your client secret
    grant_type: authorization_code is currently the only supported value
    redirect_uri: the redirect_uri you used in the authorization request. 
    Note: this has to be the same value as in the authorization request.
    code: the exact code you received during the authorization step.

This is a sample request:


    curl -F 'client_id=CLIENT_ID' \
    -F 'client_secret=CLIENT_SECRET' \
    -F 'grant_type=authorization_code' \
    -F 'redirect_uri=AUTHORIZATION_REDIRECT_URI' \
    -F 'code=CODE' \
    https://api.instagram.com/oauth/access_token



If successful, this call will return a neatly packaged OAuth Token that you can use to make authenticated calls to the API.
 We also include the user who just authenticated for your convenience:

{
    "access_token": "fb2e77d.47a0479900504cb3ab4a1f626d174d2d",
    "user": {
        "id": "1574083",
        "username": "snoopdogg",
        "full_name": "Snoop Dogg",
        "profile_picture": "..."
    }
}

Even though the access token does not specify an expiration time, 
your app should handle the case that either the user revokes access, 
or Instagram expires the token after some period of time. In this case, 
your meta of your responses will contain an “error_type=OAuthAccessTokenError”.
 In other words: do not assume your access_token is valid forever.


USER ENDPOINT:
 https://api.instagram.com/v1/users/{user-id}/?access_token=ACCESS-TOKEN

{
    "data": {
        "id": "1574083",
        "username": "snoopdogg",
        "full_name": "Snoop Dogg",
        "profile_picture": "http://distillery.s3.amazonaws.com/profiles/profile_1574083_75sq_1295469061.jpg",
        "bio": "This is my bio",
        "website": "http://snoopdogg.com",
        "counts": {
            "media": 1320,
            "follows": 420,
            "followed_by": 3410
        }
}



*/


?>