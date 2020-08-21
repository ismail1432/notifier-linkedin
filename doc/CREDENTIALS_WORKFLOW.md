#How to Get a LinkedIn API Access Token to post content with your profile.
To post content you need an access token and a profile id.

## Create Application on LinkedIn

Go to [the application dashboard](https://www.linkedin.com/developers/apps) and select "Create App".

Fill fields and got to products tab, select "Share on LinkedIn" and "Sign In with LinkedIn"

## Fetch the code

Make a `GET` request to :
`https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=[CLIENT_ID]&redirect_uri=[REDIRECT_URI]&scope=r_liteprofile%20r_emailaddress%20w_member_social`
 
From the [REDIRECT_URI] you will have `code` parameter in the query string :
http://[REDIRECT_URI]?code=THE_GIVEN_CODE.

## Exchange the code to an access_token

Make a `POST` request to `https://www.linkedin.com/oauth/v2/accessToken` with body :
`client_id` : [CLIENT_ID]
`client_secret` : [CLIENT_SECRET]
`code` : [THE_GIVEN_CODE_AT_THE_STEP_BEFORE]
`grant_type` : authorization_code
`redirect_uri` : [REDIRECT_URI]

You will have the access_token in the response: 
```bash
{
    "access_token": "THE_GIVEN_ACCESS_TOKEN"
    "expires_in": 5183999
}
```

## Get your profile ID
To post content you need a profile ID.

Make a `GET` request to `https://api.linkedin.com/v2/me?projection=(id)` with an Authorization Header.
`Authorization` : `Bearer [THE_GIVEN_ACCESS_TOKEN]`

You will have the id in the response: 
```bash
{
    "id": "THE_GIVEN_ID"
}
```

### The End

Now you can use the LinkedIn Notifier, edit the env LINKEDIN_DSN with the credentials.
```
// .env
LINKEDIN_DSN=linkedin://[THE_GIVEN_ACCESS_TOKEN]:[THE_GIVEN_ID]@default
```
