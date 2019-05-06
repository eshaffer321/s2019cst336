package com.example.project2part3;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.support.annotation.Nullable;
import android.util.Log;

import java.util.ArrayList;

public class DataBase {
    public static final String DB_NAME = "BookRental.db";
    public static final int DB_VERSION = 1;

    public static final String TABLE_BOOKS = "Books";
    public static final String TABLE_USERS = "Users";

}
