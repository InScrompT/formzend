# [FormZend](https://formzend.com)

Get form submissions delivered directly to your email. No server, no signup, no database.

*Perfect for static sites*

## Using FormZend

```html
<form action="https://formzend.com/your@email.com" method="POST">
  <input type="email" name="email">
  <input type="text" name="name">
  <input type="submit" name="Send!">
</form>
```

#### 1. Setup the form

Change your form action attribute to `https://formzend.com/your@email.com` and replace your@email.com with own
email address. 

#### 2. Add `name` attribute to every field.

Ensure all `<input>`, `<select>` and `<textarea>` elements inside your form have a name attribute, otherwise you will
not receive the data filled in these fields.

#### 3. Submit form and confirm email.

Go to your website and submit the form once. This will send you an email asking to confirm your email address.

#### 4. That's it 🎉!

From now on, when someone submits that form, we'll forward you the data as email.

## Deploying it

### Using Docker

Yeah, I know. I've made your life easy. 

- Clone this project locally.

- Copy `.env.example` to `.env.docker`
```bash
cp .env.example .env.docker
```

- Update the `.env.docker` file to the values you prefer.

- Make sure you have docker-compose, then just...
```bash
docker-compose up -d
```

### Traditional way.

This is a simple Laravel Project. So refer to [Laravel's Documentation](https://laravel.com/docs/7.x/deployment) on how to deploy.

> This project also uses [Laravel Queues](https://laravel.com/docs/7.x/queues). So make sure to set that up too

## Thanks

This project is heavily inspired by, or to be more exact, copied from the very old [FormSpree.io](https://github.com/formspree/formspree).
Used to love it, but they're now cramping in features and trying to do a lot of stuffs.

This project just plans on resurrecting the old FormSpree. No extra bells and whistles. Just does what it does.
