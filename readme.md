## Peexoo Backend Task List (https://docs.google.com/document/d/1NPN0AdWGcmCkFynvF4OGcsIW5iO9rEJ7ZKozMj0I5L0/edit)

- Login : /auth/login

- SignUp : /auth/create

- User Page : /auth/

- Community 

- HomePage

- Photographers

- Explore Photos

- Booking

- Profile

- Subscription

- Billings

- Bookings

- Albums

- 

#Notes:
- When creating the Photographer account, all necessary attributes that need to be created are 
setup, ie profile albums, subscriptions, e.t.c

- All image uploads are direct to S3 bucket, only image url is sent to the backend

- For a User's Subscription, the Object that handles it is the App/UserSubscription. 
This Subscription was/is paid for, and the Object that has details of the Payment is 
the App/UserPayment

- To create a subscription for a user, first a subscription payment url is sent to the user,
This, is created as an invoice. THis Invoice has InvoicesInstallmentPayments representing the 
installmental payments.

- When cancelling Bookings, refund only x% of the deposit money

- Private albums cannot popup on findmyface. Hidden Albums are not visible to anybody

- Bookings comments are disabled once the bookng has been accepted
