<?php
require 'connection.php';
if (isset($_POST["submit"])) {
    if (createData($_POST) > 0) {
        echo "
            <script>
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                document.location.href = 'tambah.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#productType").change(function() {
                var inputVal = $(this).val();
                var eleBox = $("." + inputVal);
                $(".type").hide();
                $(eleBox).show();
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>
                Add Product
            </h1>
        </div>
        <div class="actbutton">
            <button type="submit" name="submit" class="btn btn-light" form="product_form" id="save">Save</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <div class="container">
        <form action="" method="post" id="product_form" name="product_form" onsubmit="return validateForm()">
            <div class=" form-group row mb-3">
                <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" onkeypress="javascript:return isNumber(event)">
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="productType" class="col-sm-2 col-form-label">Type Switcher</label>
                <div class="col-sm-7">
                    <select id="productType" name="productType">
                        <option value="" disabled selected hidden>Type Switcher</option>
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
            </div>
            <div class="container">
                <div class="DVD type" style="display:none" id="divDVD">
                    <div class="form-group row mb-3">
                        <label for="size" class="col-sm-5 col-form-label">Size (MB) </label>
                        <div class="col-sm-4">
                            <input type="text" name="size" id="size" class="form-control inp" onkeypress="javascript:return isNumber(event)">
                        </div>
                    </div>
                    <strong>Please, provide size</strong>
                </div>

                <div class="Book type" style="display:none" id="divBook">
                    <div class="form-group row mb-3">
                        <label for="weight" class="col-sm-5 col-form-label">Weight (KG) </label>
                        <div class="col-sm-4">
                            <input type="text" name="weight" id="weight" class="form-control inp" onkeypress="javascript:return isNumber(event)">
                        </div>
                    </div>
                    <strong>Please, provide weight</strong>
                </div>

                <div class="Furniture type" style="display:none" id="divFurniture">
                    <div class="form-group row mb-3">
                        <label for="height" class="col-sm-5 col-form-label">Height (Cm) </label>
                        <div class="col-sm-4">
                            <input type="text" name="height" id="height" class="form-control inp" onkeypress="javascript:return isNumber(event)">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="width" class="col-sm-5 col-form-label">Width (Cm) </label>
                        <div class="col-sm-4">
                            <input type="text" name="width" id="width" class="form-control inp" onkeypress="javascript:return isNumber(event)">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="length" class="col-sm-5 col-form-label">Length (Cm) </label>
                        <div class="col-sm-4">
                            <input type="text" name="length" id="length" class="form-control inp" onkeypress="javascript:return isNumber(event)">
                        </div>
                    </div>
                    <strong>Please, provide dimensions</strong>
                </div>
            </div>
    </div>
    </form>
    </div>

</body>
<script>
    function validateForm() {
        var a = document.forms["product_form"]["sku"].value;
        var b = document.forms["product_form"]["name"].value;
        var c = document.forms["product_form"]["price"].value;
        var d = document.forms["product_form"]["productType"].value;
        var e = document.forms["product_form"]["size"].value;
        var f = document.forms["product_form"]["weight"].value;
        var g = document.forms["product_form"]["height"].value;
        var h = document.forms["product_form"]["width"].value;
        var i = document.forms["product_form"]["length"].value;

        var selected = $("#div" + d).find('.inp').val();

        if ((a == null || a == ""), (b == null || b == ""), (c == null || c == ""), (d == null || d == "")) {
            alert("Please, submit required data");
            return false;
        }

        if (selected == "") {
            alert("Please, submit required data");
            return false;
        }
        return true;
    }

    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)) {
            alert("Please, provide the data of indicated type");
            return false;
        }

        return true;
    }
</script>

</html>