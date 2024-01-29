<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Garage Booking Web App

### Build decision
I used Laravel 10 with Vue 3 and Inertia as I was on a time limit, Inertia allowed me to jumpstart the integration and 
keep everything in one place.

### Running the app
```shell
composer install
npm install
php artisan serve
npm run dev
```
### Feature List
Complete:
- [x] Submit a booking with name, email, phone number, make & model and Datetime of desired slot
- [x] Vue3 frontend form with datepicker 
- [x] Datepicker limits bookings to 30 min slots, with 9am-5:30pm limit
- [x] Datepicker limits bookings to Monday-Friday
- [x] Admin panel requiring login - allows viewing upcoming bookings
- [x] Upcoming bookings can be filtered by date using datepicker
- [x] Backend filter prevents datetimes that aren't on the hour or 30 minutes after
- [x] Backend filter prevents datetimes that would clash with an existing booking

Incomplete:
- [ ] Email notification for Owner and Customer
- [ ] Option for owner to block slots (can only be done by booking dummy slots) 

Given more time, I would have added a more comprehensive datepicker showing blocked slots, and given a lot more 
polish to the frontend. Obviously unit tests would also be a nice addition if this was more than a proof-of-concept.

### Conclusion
I found this to be a really interesting challenge, and a great opportunity to practice things I don't get to do in my 
day job. Its definitely rekindled a passion for non-commercial projects.
