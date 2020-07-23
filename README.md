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
