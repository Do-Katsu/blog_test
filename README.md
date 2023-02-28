# Blog Test

Blog Test is a simple Symfony project that demonstrates how to build a basic blog application. The application allows users to create, read, update, and delete blog posts.

## Requirements

- PHP 8.1.10 or higher
- Composer
- npm
- Symfony CLI

## Installation

1. Clone the repository: `git clone https://github.com/Do-Katsu/blog_test.git`.
2. Configure your .env.local as such: `DATABASE_URL="mysql://root@127.0.0.1:3306/blogTest"`.
3. Install the dependencies: `composer install`.
4. Install npm: `npm install`.
5. Create the database: `symfony console d:d:c`.
5. Run the migrations: `symfony console d:m:m`.
6. Run the fixtures: `symfony console d:f:l`.
6. Start the Symfony web server: `symfony server:start`.
7. Navigate to `http://localhost:8000` in your web browser.

In case the fixtures dont load, just run the command again.

## Usage

To login as an admin, these are the username/password :
### username : KebsiBadr
### password : admin

To login as an author, these are the username/password :
### username : AdrienFormateur
### password : author

## Contributing

If you want to contribute to this project, please follow these steps:

1. Fork this repository.
2. Create a new branch: `git checkout -b my-new-branch`.
3. Make changes and commit them: `git commit -am 'Add some feature'`.
4. Push to the branch: `git push origin my-new-branch`.
5. Submit a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](https://chat.openai.com/LICENSE) file for details.