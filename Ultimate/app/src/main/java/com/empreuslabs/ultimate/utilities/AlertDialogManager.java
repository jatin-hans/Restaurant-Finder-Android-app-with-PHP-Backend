package com.empreuslabs.ultimate.utilities;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import com.empreuslabs.ultimate.R;

/**
 * Created by hp pc on 12-07-2016.
 */
public class AlertDialogManager {
    public void showAlertDialog(Context context, String title, String message,
                                Boolean status) {
        AlertDialog alertDialog = new AlertDialog.Builder(context).create();

        // Setting Dialog Title
        alertDialog.setTitle(title);

        // Setting Dialog Message
        alertDialog.setMessage(message);

        if (status != null)
            // Setting alert dialog icon

            alertDialog.setIcon((status) ? R.drawable.logo
                    : R.drawable.logo);

        // Setting OK Button
        alertDialog.setButton("OK", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                finish();
            }

            private void finish() {
                // TODO Auto-generated method stub

            }
        });

        // Showing Alert Message
        alertDialog.show();
    }
}


