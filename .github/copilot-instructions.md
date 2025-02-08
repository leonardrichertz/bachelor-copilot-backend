This Laravel application should serve as a REST-Api, which delivers data to our React.js frontend.

The user uses a bearer token for all routes except the login route,
which has to get checked before data is returned.

Return data in JSON format.

All routes should have a rate-limit to prevent DOS-attacks.

Store all environment-specific context variables in .env files.

I am using Laravel 11.
