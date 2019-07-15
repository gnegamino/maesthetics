<?php

move_uploaded_file($_FILES['file']['tmp_name'], 'storage/'. $_FILES['file']['name']);

response(["message" => ""]);