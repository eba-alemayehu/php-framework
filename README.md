# Dmu php framework documentaion
# Introduction

This PHP framework is developed in debremarkos university by 4th year software engineering students in 2020. The farmework is an MVC frame work. It implement basic MVC architectue with routing and some database related features. 

# Installation 

In order to use this framework you need the following installed on your system: 

```
    - PHP >7.0
    - composer 
    - git 
```

If you are on windows and using XAMPP you need to configer global path variable for php. 

To create new project it is easy. first clone the project from git hub. 

``` bash
   $ git clone --depth 1 https://github.com/eba-alemayehu/php-framework.git
```

After cloing the git repo, go to the project dir and install all composer dependencies 

``` bash 
    $ cd php-framework 
    $ composer update
```
_<b>NB</b>: Feel free to change the name of the project dir._

Now you are ready to use the framework. To test the framework is runing correctly. run this command 

``` bash 
    $ php application serve
```

After runing this command the framework should be runing on localhost on spacified port at the console output of the command by defalut http://localhost:8080. open the link on the browser. Now if everyting going ok we are ready to go. 

# Basics 
## Configration

All configrations about your application are stored in `config` directory. In config dir there are two files `app.config.php` and `database.config.php`.

`app.config.php`

    ``` php 
        return [
            'app_name' => 'Library', 
            'root_URL' => 'http://localhost',
            'debug' => true
        ]; 
    ```

In this configation file we configer three things. The name of the our application, the root url and debuging mode which determines if the appliaction is on debuging or production. 

`database.config.php` 

    ``` php 
        return [
            'db_connection' => 'mysql', 
            'db_host' => 'localhost',
            'db_name' => 'mydb',
            'db_port' => '3306', 
            'db_username' => 'root',
            'db_password' => ''
        ]; 
    ```
All our database configrations are configered in this configration file. 

## Routing 
 
The framework has its own system of routing. The framework diverts the default routing system of the web server and handel all the requesting comming to the your application. There for you need to define all routes (URLS) comming to your application and define what happens to each requst. 

Go to ``` routes/router.php ``` start to write your routes. 

    ```php
        $this->get('/', 'HomeController@indx'); 
    ```
This get method defeines a url whitch runs ```index``` method in ```HomeController``` when ever ```/``` is requested with GET http request. 

As you now php has 2 basic Http request methos with are ``` GET and POST ``` methods, but this frame work implemnts two more methos with are ```PUT and DELETE``` for http request. 

    ``` php
        $this->post('/user', 'UserController@store');
        $this->put('/user', 'UserController@update');
        $this->delete('/user', 'UserController@update');
    ```

Inorder to use ```PUT and DELETE``` methods you need to send _put and _delete values on method param respectively with ```POST``` request. 

_<b>Example</b> html form for put request_

    ``` html
        <from method='POST' action='/user'>
            <input type="text" name="method" value="_put" hidden />
            <input type="text" name="id" value="1" hidden />
            <input type="text" name="name" /> 
            <input type="text" name="email"/>
            <input type="password" name="password"/>
            <input type="submit" value="Update"/>
        </from>
    ```

_NB: If you are using any kind of javascript frame work or http library, you are more likely to get this put and delete methos along with post and get methods._

You may want your urls to have the same name as the neme of the method in your controller. Like if your url is ``` /user/store ``` your method in controller method identifier be ``` postStore ```. The frist word in the camel casing deffines the request method of the url. hear is how you diffine this kind of routes. 

    ``` php 
        $this->controller('/user', 'UserController'); 
    ```
In ``` UserController ```, hear is how you defene methods. 

    ``` php 
        class UserController{
            public function postStore(){
                ...
            }
        }
    ```

This is equivalent to: 

    ``` php 
        $this->post('/user/store', 'UserController@postStore'); 
    ```

You can define as many methos as you want and all public methods will be maped to the route. 

Some routes may have same prefix or may use same middeleware (will be discussed letter). To group this simmilar routes you may use group method. 

    ``` php 
        $this->group(["prefix" => "/user", "middelware" => ['Auth']], function(){
            $this->get('/index', 'UserController@index'); 
            $this->post('/store', 'UserController@store'); 
        }); 
    ```
_This will generate the following urls which all are protected by Auth middelware_

    ```
        /user/index                     GET
        /user/store                     POST
    ```

In outher way you may also group routes by using prefix or middelware methods. 

    ``` php
    $this->prefix('/user')
    $this->middelware('Auth'); 

    $this->get('/index', 'UserController@index'); 
    $this->post('/store', 'UserController@store'); 

    $this->endPrefix(); 
    $this->endMiddelware('Auth');
    ```

This has similar results are the above example but with diffrent expression. 

## Controllers 

Controllers in MVC architecture are the ones which handele all the business logic of your appliacaion. An http request is direced to controllers to handel the requst. In the framework controllers are found in `/app/http/controllers` dir. 

We have got a console helper to create a controller. It will create a controller with proper templet. 

    ``` bash 
        $ php application make:controller User
    ```
The command will create `UserController.php` in controller dir. Now you can open the php file and work on the controller your favorite editor. 

You can deffine methods in The controller class. You may return a view object with will render html written on view file or any php object with automatically encoded to json responce; 

    ``` php 
        use Application\Support\View; 

        class UserController {
            public function index(){
                return View::view('home'); 
            }
            public function store(){
                return 'Data is stsored'; 
            }
        }
    ```

_<b>NB: </b> Your views should be stored in `/app/Resource/views` dir. You don't need to add the `.php' extention to in view method. If the view file is stored in diffrent dir in side views dir you can refrance the view by / or . separator._

    ``` php
        // view is stored in /app/Resource/views/pages
        public function index(){
           return View::view('pages.home'); 
        }
    ```
## Datbase migrations

Migrations are classe with are responsible for createing tables in database. This frame work allows you to define migrations in applation and migrate the migrations to create tables on the databsae. Every migraion will have a corresponding model with it. The framework provieds helper console command to create both migration and model at the same time. 
    ``` bash 
        $ php application make:migration User
    ```

This console command will create `app/Database/Migration/UserMigration.php` and `app/Model/User.php` this are migration and model respectively for user table in database. 

In your migration class you can start defining the attibutes or columnees of your table inside `up` method. 

    ``` php
        namespace App\Database\Migrations;


        class UserMigration extends \Application\Database\Table
        {
            public function up(){
                parent::increment("id");
                parent::string('name'); 
                parent::decimal('wight'); 
                // createed at and updated at
                parent::datetime("created_at", parent::NULL);
                parent::datetime("updated_at", parent::NULL, parent::DEFAULT_UPDATE_TIME);
            }
        }
    ```

By defalt every migration will have create_at and updated_at attibutes you can remove thouse attributes if you don't need them in your table. you can use the fallowing methods to deffine attibutes. 

    ``` php 
    parent::increment() // create autoincrement int attribute
    parent::int('count', parrent::NULL) // create integer col
    parent::string('name') // create varchar col
    parent::boolean('is_admin', parrent::NOT_NULL, 1) // create boolean col
    parent::decimal('weght') // create decial col 
    parent::date('dob') // create date col 
    parent::datetime('verfied_at') // create datetime col 
    
    ```

    - All methods take the name of col as the first attribute
    - All methods except increment take nullbality as secode attirbte. 
    - All methods except increment, date and datetime take size as third attribute. 
    - All methods except increment take default value as last attirbte. 

After you finish writting your miggration class. You can use 

    ``` bash 
        $ php applicatoin migrate
    ```

to create tables on your database. This command will migrate all migrations in side the migrations dir, but if you only want to migrate a spacific dir you can spacify the name of migration you want to migrate. 

    ``` bash 
        $ php application migrate UserMigration
    ```

This only migrate `UserMigration`. 

## Views 

Views are simply an html pages which is rendered in browser. The mvc arctctue dectates views are only used to render or view data to the user. All the bussiness logic should be written in controller and the data is passed to the view. we use the `with' method in view object. 

     ``` php 
        use Application\Support\View; 

        class UserController {
            public function index(){
                $a = 2; 
                $b = 3; 
                $sum  = $a + $b; 
                return View::view('home')->with('sum', $sum); 
            }
        }
    ```

The variable sum is passed to the veiw as sum. Now we can print this variable insiede our view.


    `home.php`
    ``` html
        <h1> <?= $sum ?> </h1> 
    ```

You can pass as many varibales as you want by chaining the with method. 

    ``` php 

        return View::view('home')
                ->with('sum', $sum)
                ->with('var', $var); 

    ```

## Models 

Models provied an object orianted interface to a table. 