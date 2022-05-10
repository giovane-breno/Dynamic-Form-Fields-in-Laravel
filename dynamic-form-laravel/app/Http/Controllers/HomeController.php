<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use stdClass;

class HomeController extends Controller
{
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
}
