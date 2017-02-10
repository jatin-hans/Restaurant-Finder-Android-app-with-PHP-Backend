package com.empreuslabs.ultimate.Activities;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.utilities.RegisterUserClass;

import java.util.HashMap;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class RegActivity extends AppCompatActivity implements View.OnClickListener{

    private EditText editTextName;
    private EditText editTextMobile;
    private EditText editTextPassword;
    private EditText editTextEmail;

    private Button buttonRegister;

    private static final String REGISTER_URL = "http://192.168.43.73/Backend/RegisterUser.php";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reg);

        editTextName = (EditText) findViewById(R.id.editTextName);
        editTextEmail = (EditText) findViewById(R.id.editTextEmail);
        editTextMobile = (EditText) findViewById(R.id.editTextMobile);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);

        buttonRegister = (Button) findViewById(R.id.buttonRegister);

        buttonRegister.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        if(v == buttonRegister){
            registerUser();
        }
    }

    private void registerUser() {
        String name = editTextName.getText().toString().trim().toLowerCase();
        String mobile = editTextMobile.getText().toString().trim().toLowerCase();
        String password = editTextPassword.getText().toString().trim().toLowerCase();
        String email = editTextEmail.getText().toString().trim().toLowerCase();

        if(validate()) {
            register(name, email, mobile, password);
            clearField();
            back2login();
        }else{

            Toast.makeText(getApplicationContext(),"Please Enter Valid Information to create an account", Toast.LENGTH_LONG).show();
        }
    }

    private boolean validate() {

        if (isValid(editTextEmail.getText().toString())&&editTextMobile.getText().toString().length()==10&&
                editTextPassword.getText().toString().length()>=8
                &&editTextName.getText().toString().length()>3) {
            return true;
        }else{
            return false;
        }

    }

    private void back2login() {

        Toast.makeText(getApplicationContext(),"Please Login to continue..", Toast.LENGTH_LONG).show();
        Intent it1=new Intent(getApplicationContext(),ActivityLogin.class);
        startActivity(it1);
    }

    private void clearField() {
        editTextName.setText("");
        editTextEmail.setText("");
        editTextMobile.setText("");
        editTextPassword.setText("");
    }

    private void register(String name, String email, String mobile, String password) {
        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            RegisterUserClass ruc = new RegisterUserClass();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(RegActivity.this, "Please Wait",null, true, true);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(getApplicationContext(),s, Toast.LENGTH_LONG).show();
            }

            @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String,String>();
                data.put("name",params[0]);
                data.put("email",params[1]);
                data.put("mobile",params[2]);
                data.put("password",params[3]);


                String result = ruc.sendPostRequest(REGISTER_URL,data);

                return  result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(name,email,mobile,password);
    }

    public static boolean isValid(String email)
    {
        String expression = "^[\\w\\.-]+@([\\w\\-]+\\.)+[A-Z]{2,4}$";
        CharSequence inputStr = email;
        Pattern pattern = Pattern.compile(expression, Pattern.CASE_INSENSITIVE);
        Matcher matcher = pattern.matcher(inputStr);
        if (matcher.matches())
        {
            return true;
        }
        else{
            return false;
        }
    }

}
