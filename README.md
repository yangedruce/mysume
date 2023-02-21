# Mysume Documentation

Mysume is a resume builder developed using Laravel 8 and stylized with Bootstrap 5. It features a resume builder with selectable template which can be shared and viewed publicly.

# Setup

To setup Mysume in your local machine, simply run this command below where 'app' is the name of the folder of the project.

```shell
git clone https://github.com/yangedruce/mysume.git app
```

Run this command below in your project directory to install all required vendor files .

```shell
composer install
```

Run this command below in your project directory to create .env file.

```shell
cp .env.example .env
```

Run this command below in your project directory to generate key in .env file.

```shell
php artisan key:generate
```

In order for Mysume to work, you must set your email configuration in .env file. You may use [mailtrap.io](http://mailtrap.io/) for development purpose and use it's SMTP integration codes in your .env file.

Next, you may create a corresponding database using a Database Management System and setup the configurations for the database in your .env file.

After completing the steps above, simply run this command below.

```shell
php artisan config:cache
```

Migrate the tables and required seeder file to your database using the command below.

```shell
php artisan migrate --seed
```

Run command below to setup link for storage files

```markdown
php artisan storage:link
```

[The wireframes and design](https://www.figma.com/file/zsQqGrYLO1sjGQWb6hBSoF/Resume-Builder-Mysume?node-id=0%3A1)

You may view the app live [here](https://www.mysume.yangedruce.com/)

That's it! Your own Mysume app is now ready.
