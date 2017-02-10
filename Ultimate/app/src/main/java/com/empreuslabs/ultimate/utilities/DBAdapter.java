package com.empreuslabs.ultimate.utilities;

import android.content.Context;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;

/**
 * Created by hp pc on 13-07-2016.
 */
public class DBAdapter extends SQLiteOpenHelper {


    private static String DB_PATH = "/data/data/redixbit.restaurant/databases/";

    private static String DB_NAME = "restaurant.sqlite";

    private SQLiteDatabase myDataBase;

    private final Context myContext;



    public DBAdapter(Context context) {
        super(context, DB_NAME, null, 1);
        this.myContext = context;
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        boolean dbExist = checkDataBase();

        if (dbExist) {

        } else {
            this.getReadableDatabase();

            try {

                copyDataBase();

            } catch (IOException e) {
                Log.d("Error", "Copy Database");
                throw new Error("Error copying database" + e);

            }
        }

    }


    public void createDataBase() throws IOException {

        boolean dbExist = checkDataBase();

        if (dbExist) {

        } else {
            this.getReadableDatabase();

            try {

                copyDataBase();

            } catch (IOException e) {
                Log.d("Error", "Copy Database");
                throw new Error("Error copying database" + e);

            }
        }
    }


    private boolean checkDataBase() {

        File dbFile = new File(DB_PATH + DB_NAME);
        Log.d("db", "" + dbFile);
        return dbFile.exists();
    }


    @Override
    public synchronized SQLiteDatabase getReadableDatabase() {
        return super.getReadableDatabase();
    }

    @Override
    public synchronized SQLiteDatabase getWritableDatabase() {
        // TODO Auto-generated method stub
        return super.getWritableDatabase();
    }

    private void copyDataBase() throws IOException {
        InputStream myInput = myContext.getAssets().open(DB_NAME);
        String outFileName = DB_PATH + DB_NAME;
        OutputStream myOutput = new FileOutputStream(outFileName);
        byte[] buffer = new byte[1024];
        int length;
        while ((length = myInput.read(buffer)) > 0) {
            myOutput.write(buffer, 0, length);
        }

        myOutput.flush();
        myOutput.close();
        myInput.close();
    }

    public void openDataBase() throws SQLException {

        String myPath = DB_PATH + DB_NAME;
        myDataBase = SQLiteDatabase.openDatabase(myPath, null,
                SQLiteDatabase.OPEN_READONLY
                        | SQLiteDatabase.NO_LOCALIZED_COLLATORS);

    }

    @Override
    public synchronized void close() {

        if (myDataBase != null)
            myDataBase.close();

        super.close();

    }



    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }



    public Cursor getName() throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from old ;", null);
        return cur;
    }

    public Cursor getChapter(String id) throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from hindibible where Book=" + id
                + " and Chapter=1", null);

        // cur =
        // myDataBase.rawQuery("select * from hindibible where Book="+id+" and Chapter="+id+";",
        // null);
        return cur;

    }

    public Cursor getChapter1(String name, int id) throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from hindibible where Book=" + name
                + " and Chapter=" + id + "", null);

        // cur =
        // myDataBase.rawQuery("select * from hindibible where Book="+id+" and Chapter="+id+";",
        // null);
        return cur;

    }

    public Cursor getChapter2(String name, int id) throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from hindibible where  Book="
                + name + " and Chapter=" + id + "", null);

        // cur =
        // myDataBase.rawQuery("select * from hindibible where Book="+id+" and Chapter="+id+";",
        // null);
        return cur;

    }

    public Cursor getName1() throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from new ;", null);
        return cur;
    }

    public Cursor getFavourite() throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from Dictionary where isFav=1;",
                null);
        return cur;

    }

    public Cursor getFavourite1() throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from hindibible where IsFav=1;",
                null);
        return cur;

    }

    public Cursor getNotes() throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from notes;", null);
        return cur;

    }

    public Cursor getNotes1() throws SQLException {
        Cursor cur;
        cur = myDataBase.rawQuery("select * from level;", null);
        return cur;

    }

    public Cursor getquestion(int id) throws SQLException {
        Cursor cur;
        String query = "select * from bibleqtable where SlNo=" + id + ";";
        Log.d("QUERY", "" + query);
        cur = myDataBase.rawQuery("select * from bibleqtable where SlNo=" + id
                + ";", null);

        return cur;

    }

    public Cursor getFrench(String id) throws SQLException {
        // Cursor
        // cur=myDataBase.rawQuery("select * from Dictionary where English='"+name+"';",null);
        Cursor cur;
        cur = myDataBase.rawQuery("select * from Dictionary where Id=" + id
                + ";", null);
        return cur;
    }

    public Cursor getFvrt(int str) throws SQLException {

        Cursor cur;
        cur = myDataBase.rawQuery("select * from hindibible where ID=" + str
                + ";", null);

        return cur;
    }

    public Cursor getAll(String name) throws SQLException {
        Cursor cur;

        if (name.equals("*")) {
            // cur = myDataBase.rawQuery("select English from Dictionary ;",
            // null);
            cur = myDataBase
                    .rawQuery(
                            "select English,Hindi from Dictionary order by random() limit 1 ;",
                            null);
        } else {
            cur = myDataBase.rawQuery("select * from Dictionary ;", null);

        }
        return cur;
    }

    public Cursor getday(String name) throws SQLException {
        Cursor cur;

        if (name.equals("*")) {
            // cur = myDataBase.rawQuery("select English from Dictionary ;",
            // null);
            cur = myDataBase.rawQuery(
                    "select NKJ from hindibible order by random() limit 1 ;",
                    null);
        } else {
            cur = myDataBase.rawQuery("select * from Dictionary ;", null);

        }
        return cur;
    }

    public Cursor getSearchData(String name) {
        String QUERY = "select * from Dictionary where English LIKE '" + name
                + "%';";
        Log.d("QUERY", "" + QUERY);
        Cursor cur = myDataBase.rawQuery(QUERY, null);
        if (cur != null) {
            Log.d("NEWDATA", "" + cur);
            cur.moveToFirst();
        }

        return cur;
    }

    public Cursor getFavData(String query) throws SQLException {
        // Cursor
        // cur=myDataBase.rawQuery("select * from Dictionary where English='"+name+"';",null);
        Cursor cur;
        myDataBase = this.getWritableDatabase();
        cur = myDataBase.rawQuery(query, null);
        Log.d("QUERY_FAV", query);
        return cur;
    }

    public Cursor getnotes1(String name) throws SQLException {

        Cursor cur;
        cur = myDataBase.rawQuery("select * from hindibible where Version="
                + name + ";", null);
        return cur;
    }



}
