package com.example.project2part3;

import android.provider.ContactsContract;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    private Button createAccountButton;
    private Button cancelHoldButton;
    private Button manageSystemButton;
    private Button placeHoldButton;
    private TextView createUsernameTextView;
    private EditText getUsernameEditText;
    private TextView createPasswordTextView;
    private EditText getPasswordEditText;

    private DataBase dbBooks;
    private DataBase dbUsers;

    @Override
    protected void onCreate(final Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

//        dbBooks = new DataBase(this);
//        dbUsers = new DataBase(this);

        createAccountButton = findViewById(R.id.createAccountButton);
        cancelHoldButton = findViewById(R.id.cancelHoldButton);
        manageSystemButton = findViewById(R.id.manageSystemButton);
        placeHoldButton = findViewById(R.id.placeHoldButton);

        createAccountButton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                setContentView(R.layout.createactivity_main);

                createUsernameTextView = findViewById(R.id.createUsernameTextView);
                getUsernameEditText = findViewById(R.id.getUsernameEditText);
                createPasswordTextView = findViewById(R.id.createPasswordTextView);
                getPasswordEditText = findViewById(R.id.getPasswordEditText);
            }
        });
    }
}
