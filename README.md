# CSCI E-15 Project 2

[Visit Site](http://p2.scottpullen.me)

[Demo](http://screencast.com/t/AT4jKcS2jZPe)

## Description
This application generates a password. The password is built using ordinary words (no l337 speak) along with some configurations on the output. The generated password is easy to remember, but is hard for a computer to crack. The idea comes from [xkcd](http://xkcd.com/936/).

## Features
- Choose from 3 - 6 words for the password
  - Field is validated, only allows the number of words to be between 3 and 6
  - Displays an error message on the page if it fails validation
- Optionally choose a word separator
  - Field is also validated, only allows -_.#
  - Displays an error message on the page if it fails validation
- Optionally include a number
  - Randomly chooses a number between 0 and 9
- Optionally include a special character
  - Randomly chooses !@#$%&
- Optionally upper case first letter of password
- Optionally camel case the password
- Uses AJAX to retrieve a password from an end-point
  - The logic to generate the password is shared between the main page and the end point via a class
  - Falls back to just posting back to the main page if javascript is disabled
  - jQuery provided the AJAX support
- Used an external source to build the word list
- Used bootstrap to style the page

## Resources
- [jQuery](http://jquery.com)
- [Bootstrap](http://getbootstrap.com)
- [spinner image](http://spiffygif.com/)
- [word list](https://github.com/first20hours/google-10000-english) (filter words < 3 characters)