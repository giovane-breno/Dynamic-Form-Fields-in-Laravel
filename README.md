<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h3 align="center"><p align="center">Dynamic Form Fields in Laravel</p></h3>
 <p align="center">Add more fields in a form dynamically, retrieve and save in database.</p>

  <p align="center">
    <a href="https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel">View Demo</a>
    ·
    <a href="https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel/issues">Report Bug</a>
    ·
    <a href="https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel/issues">Request Feature</a>
  </p>
</div>

<p align="center"><a href="https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel/graphs/contributors" alt="Contributors">
        <img src="https://img.shields.io/github/contributors/giovane-breno/Dynamic-Form-Fields-in-Laravel" /></a> <a href="https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel/blob/main/LICENSE"><img src="https://camo.githubusercontent.com/710a6522ecfcecef911b46d1fd71998a6d4be992d0a23d559faee1b5c68cb27a/68747470733a2f2f696d672e736869656c64732e696f2f6769746875622f6c6963656e73652f4e61657265656e2f5374726170446f776e2e6a732e737667" alt="GitHub license" data-canonical-src="https://img.shields.io/github/license/giovane-breno/Dynamic-Form-Fields-in-Laravel" style="max-width: 100%;"></a><a href="https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel/graphs/stars" alt="stars">
        <img src="https://img.shields.io/github/stars/giovane-breno/Dynamic-Form-Fields-in-Laravel" /></a><br><img src="https://camo.githubusercontent.com/7d1b3c7e8885ac55b920379c555c2399398f13524e30fe14d5fca83749d0a091/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f2d4c61726176656c2d3333333333333f7374796c653d666c6174266c6f676f3d6c61726176656c" alt="Laravel" data-canonical-src="https://img.shields.io/badge/-Laravel-333333?style=flat&amp;logo=laravel" style="max-width: 100%;"> <img src="https://camo.githubusercontent.com/bd329f61f047c80b2a1f5483a6a7a0d59e0fdf28527b594ab05149f3d69f0b85/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f2d426f6f7473747261702d3333333333333f7374796c653d666c6174266c6f676f3d626f6f747374726170" alt="BootStrap" data-canonical-src="https://img.shields.io/badge/-Bootstrap-333333?style=flat&amp;logo=bootstrap" style="max-width: 100%;"> 
</p>
<br>


## 🛠️ About The Project

I have built this project in motivation of my difficulties when developing some personal projects.<br>So, in a try of helping some new programmers I published this template repository.<br>If this helped you, please leave a star. 🙂
<br><br>
Basically, this project is the recipe to build dynamic forms.<br>When you click (+), It add one more field to type and later save all the fields in a database.

## 💻 Project Working

![image](https://user-images.githubusercontent.com/57039322/167750487-733f6b1f-8a60-48e5-8a64-f076d6d91225.png)
![image](https://user-images.githubusercontent.com/57039322/167750501-9239404c-a7d2-40d0-ba2b-7694d9f6bb99.png)


## 💠 Set-up the project

Before running the project, you need to set-up the database and table.<br>You can just copy and paste the SQL code below, if you want.

```sql 
CREATE DATABASE `laravel`;

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `field_content` varchar(355) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
);

```

After setting up the database, you have to clone this repo.<br>
<pre>git clone https://github.com/giovane-breno/Dynamic-Form-Fields-in-Laravel.git</pre>
Then run Laravel serve command.
<pre>php artisan serve</pre>

## 💡How the code works

In `Index.blade.php` we have a mix of HTML and JavaScript to the project work properly.

```html 
<!--
** Mother container, with the first input and buttons.
-->
<div class="container d-flex justify-content-center h-100">
    <div class="my-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><img src="/favicon.ico" alt="Laravel" class="d-inline-block icon"> Dynamic
                    Form Fields in Laravel </h4>
                <form method="POST" action="/add">
                    @csrf
                    <input type="hidden" value="0" name="TotalForms">
                    <div class="form-group first">
                        <div class="row" id="row_1">
                            <div class="col-10 ">
                                <input class="form-control" placeholder="Field 1" type="text" name="field[]" id="field_1">
                            </div>
                            <div class="col-2">
                                <a type="button" class="btn btn-danger" id="delItem"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer ">
                <a type="button" class="btn btn-success" id="addItem"><i class="fas fa-plus"></i></a>
                <button type="submit" class="btn btn-primary float-end">Submit</i></button>
            </div>
            </form>
        </div>
    </div>
</div>
```

We have JavaScript functions in `Index.blade.php` that make all working. `(Add or Remove Fields)`

```js
//delItem Function, called by a click in an ID.
$(document).on("click", "#delItem", function() {
    $(this).closest('.form-group').remove(); // Remove the closest element that have 'form-group' in class.
});
```

```js      
// call addItem function
$('#addItem').click(function() {
    $.addItem(); // call addItem function
});
```
```js
//addNewProduct Function
let count = 1; // define field counter
$.addItem = function() {
    count++; // Sum 01 per function call

    var tmplMarkup = $("#item-order").html(); // define our HTML template
    var compiledTmpl = tmplMarkup.replace(/_prefix_/g, count); // change _prefix_ to number
    $(".first").append(compiledTmpl); // define where we want to place our template
    $('#TotalForms').val(count); // sum TotalForms
    $('.col-10').focus(); // focus next input (defined by class 'col-10')
}
```

Form Template | the ID order is defined by [__prefix__] so you must not remove it.<br>
This script would be placed in the bottom of `Index.blade.php`.

```js
<script type="text" id="item-order">
    <div class="form-group">
        <div class="row mt-3" id="row__prefix_">
            <div class="col-10 ">
                <input class="form-control" placeholder="Field _prefix_" name="field[] type="text" id="field__prefix_">
            </div>
            <div class="col-2">
                <a type="button" class="btn btn-danger" id="delItem"><i class="fas fa-trash-alt"></i></a>
            </div>
        </div>       
    </div>
</script>
```

## 🌀 Laravel Controller
Controller functions in this project, localized in `HomeControler.php`
```php
// Retrieve all input fields.
function getFieldsContent($request){
    $input = $request->all(); 

    $field = $request->input('field'); //Retrieve input from request

    foreach ($input['field'] as $index => $input) { // Loop to get all inputs and save in a object
        $FieldContent[$index] = new stdClass(); // Make a new null object
        $FieldContent[$index]->field_content = $field[$index]; // Field (Object with value field_content) will be field[index]
    }

    return $FieldContent; // Return Object
}
```
```php
// Save inputs to database
function addItem(Request $request){
    
    $FieldContent = $this->getFieldsContent($request);
    foreach ($FieldContent as $key) {  // Forloop to save in database one per one item. ($key)
        $field = new Field(); // Instance database model
        $field->field_content = $key->field_content; // field->field_content (database instance and database cell)

        if (!$field->save()) { // if error when saving to db
            return redirect('/')->with('error', 'Unsuccessful submitted!'); //return with this message
        }

    }

    return redirect('/')->with('success', 'Successfully submitted!'); // if success :) throw this

}
```

## 🌐 Laravel Routes
Routes in `web.php`, used in this project.
```php
Route::get('/', function(){ return view('index'); });
Route::post('/add', 'App\Http\Controllers\HomeController@addItem'); // Call addItem function from Form action
```

##
