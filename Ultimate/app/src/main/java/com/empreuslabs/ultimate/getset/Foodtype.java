package com.empreuslabs.ultimate.getset;

/**
 * Created by hp pc on 18-07-2016.
 */
public class Foodtype {
    String image_id, tbl_images,foodtype,vegtype,price,img;

    String getImage_id() {
        return image_id;
    }

    public void setImage_id(String image_id) {
        this.image_id = image_id;
    }

    public String getTbl_images() {
        return tbl_images;
    }

    public void setTbl_images(String tbl_images) {
        this.tbl_images = tbl_images;
    }

    public String getimg() {
        return img;
    }

    public void setimg(String img) {
        this.img = img;
    }
    public String getFoodtype() {

        return foodtype;
    }

    public void setPrice(String price) {
        this.price = price;
    }
    public String getPrice() {

        return price;
    }

    public void setFoodtype(String foodtype) {
        this.foodtype = foodtype;
    }
    public String getVegtype() {
        return vegtype;
    }

    public void setVegtype(String vegtype) {
        this.vegtype = vegtype;
    }

}
