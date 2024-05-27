# Auth System Support FreeIPA

## Project Overview
This project is developed  as part of a technical evaluation. It implements a dynamic user authentication system using Laravel. This system includes user registration and login functionality. The initial setup does not include external libraries for the frontend, utilizing Blade with Tailwind CDN.

## Features
- User Registration: Allows new users to register by providing essential information such as username, email, and password.
- User Login: Users can log in using either their traditional credentials or via FreeIPA, specifically if they belong to the 'elite' group.

# Code Documentation

1. Login Controller

In the LoginController, the attemptLogin function plays a crucial role. It determines whether the authentication will proceed against our local database or the FreeIPA server.

2. Configuration in auth.php

- Guards and Providers: The configuration file auth.php is set up with two guards and two providers. This setup allows for authentication flexibility, enabling us to handle both LDAP (using FreeIPA) and non-LD state (local database).
- LDAP Integration: When a user attempts to log in via LDAP, the system checks if they belong to the 'elite' group. This serves as a type of authorization check, ensuring that only members of specific groups can access certain functionalities.
- User Data Handling: Upon successful LDAP authentication, user data from the FreeIPA demo server is imported into our local database. This allows us to manage user information effectively within our application.
- Unique Identifier: Each user in our database is uniquely identified by a combination of their user_name, domain, and guid.

3. Environment Configuration (env.example)

    The .env.example file contains the necessary parameters to establish a connection with the FreeIPA server. Here are the LDAP settings used:
- LDAP_HOST: ipa.demo1.freeipa.org
- LDAP_USERNAME: uid=admin,cn=users,cn=accounts,dc=demo1,dc=freeipa,dc=org
- LDAP_PASSWORD: Secret123
- LDAP_BASE_DN: cn=users,cn=accounts,dc=demo1,dc=freeipa,dc=org

4. Registration Functionality

- Although registration is not a primary requirement for this project, it has been implemented to facilitate easier testing and interaction during the development phase (local database only) .

5. Frontend Implementation
- The frontend design is intentionally straightforward, focusing solely on demonstrating the authentication mechanisms effectively without additional complexity.

Please feel free to reach out if you need further explanation on any part of the code.
