<?php
function Help_all_input_normal($id = null, $type = null, $name = null, $value = null, $label = null, $title = null, $placeholder = null, $requried = null, $autofocus = null, $autocomplete = null, $step = null, $min = null, $max = null, $minlength = null, $maxlength = null, $data_persely = null, $rows = null, $cols = null, $attr = null)
{
    $errors = Session::get('errors', new Illuminate\Support\MessageBag);
    if ($id == 'password-confirm') {
        $confirm = 'data-parsley-equalto="#password"';
    } else {
        $confirm = '';
    }
    if ($requried == 'true') {
        $required = 'required';
        $required_text = '<span class="text-danger">*</span>';
    } else {
        $required = '';
        $required_text = '';
    }
    if ($autofocus == 'true') {
        $autofocus = 'autofocus';
    } else {
        $autofocus = '';
    }
    if ($step == 'true') {
        $step = 'step="' . $step . '"';
    } else {
        $step = '';
    }
    if ($max != null) {
        $max = 'max="' . $max . '"';
    } else {
        $max = '';
    }
    if ($min != null) {
        $min = 'min="' . $min . '"';
    } else {
        $min = '';
    }
    if ($maxlength != null) {
        $maxlength = 'maxlength="' . $maxlength . '"';
    } else {
        $maxlength = '';
    }
    if ($minlength != null) {
        $minlength = 'minlength="' . $minlength . '"';
    } else {
        $minlength = '';
    }
    if ($autocomplete == 'true') {
        $autocomplete = 'autocomplete="' . $autocomplete . '"';
    } else {
        $autocomplete = 'autocomplete="' . $autocomplete . '"';
    }

    if (is_array($value)) {
        $val = '';
        $image = home_base_url($value[1]) . '/' . $value[0];
    } else {
        if ($name != null) {
            if ($value != '') {
                if ($type === 'textarea') {
                    $value;
                } else {
                    $val = '
                            value="' . $value . '"
                    ';
                }
            } else {
                if ($type === 'textarea') {
                    $val = '';
                } else {
                    $val = '
                            value="' . old($name) . '"
                    ';
                }
            }
        } else {
            $val = '';
        }
    }



    if ($placeholder  != null) {
        $placeholder = 'placeholder="' . $placeholder . '"';
    } else {
        $placeholder = '';
    }
    if ($data_persely  != null) {
        $data_persely = 'data-parsley-equalto="#' . $data_persely . '"';
    } else {
        $data_persely = '';
    }
    if ($rows  != null) {
        $rows = 'rows="' . $cols . '"';
    } else {
        $rows = '';
    }
    if ($cols  != null) {
        $cols = 'cols="' . $cols . '"';
    } else {
        $cols = '';
    } ?>
<div class="form-group <?php echo $errors->has($name) ? ' is-danger' : '' ?>" title="<?php echo $title; ?>">
    <?php
    if ($label != '') {
        ?>
    <label for="<?php echo $id ?>"><?php echo __($label) ?> <?php echo $required_text ?> </label>
    <?php
    }
    if ($type === 'textarea') {
        ?>
    <textarea id="<?php echo $id ?>" name="<?php echo $name ?>" <?php echo $placeholder ?> class="form-control" <?php echo $rows; ?> <?php echo $cols; ?> <?php echo $required ?> <?php echo $maxlength ?> <?php echo $attr ?>> <?php echo $value ?> </textarea>
    <?php
    } else {
        ?>

    <input <?php echo $confirm ?> type="<?php echo $type ?>" id="<?php echo $id ?>" name="<?php echo $name ?>" <?php echo $placeholder ?> <?php echo $val ?> class="form-control" <?php echo $required ?> <?php echo $step ?> <?php echo $max ?> <?php echo $min ?> <?php echo $maxlength ?> <?php echo $minlength ?> <?php echo $autocomplete ?> <?php echo $autofocus ?> <?php echo $data_persely ?> <?php echo $attr ?>>

    <?php
    }
    if ($errors->has($name)) {
        ?>
    <span class="text-danger">
        <?php echo $errors->first($name) ?>
    </span>
    <?php
    }
    if (is_array($value)) {
        echo '
                <div class="image-form">
                    <img src="' . $image . '" alt="edit-image" class="img-fluid">
                </div>
             ';
    } ?>
</div>
<?php
}


/*
*
* coding for card with input helper
*
*/

function helper_card_with_input(int $id, string $name, array $value = null, string $btn_type = null, string $btn_name = null, $btn_class = null)
{
    if ($btn_type != null) {
        $button = '
        <div class="card-footer">
            <button type="' . $btn_type . '" name="' . $btn_type . '"  class="' . $btn_class . '">' . $btn_name . '</button>
            </div>
         ';
    } else {
        $button = '';
    } ?>
<div class="card mt-2">
    <div class="card-header  d-flex  justify-content-between align-items-center">
        <h4 class="m-0"><i class="fas fa-server"></i> <?php echo $name ?></h4>
        <div class="minus" id="minus-<?php echo $id; ?>">
            <i class="fas fa-minus"></i>
        </div>
    </div>
    <div class="card-body" id="body-<?php echo $id; ?>">
        <?php
        if (is_array($value)) {
            foreach ($value as $data) {
                echo Help_all_input_normal($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17]);
            }
        } ?>
    </div>
    <?php echo $button; ?>
</div>
<?php
}
/*
* for Home Url Or base Url
*/
function home_base_url($data)
{
    $base_url = (isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
    $base_url .= $_SERVER['HTTP_HOST'] . '/' . $data;
    return $base_url;
}
/*
* for select 2 Js
*/
function colorPickerjs()
{
    return '<script src="' . home_base_url('backend/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') . '" defer></script>';
}
/*
* for select 2 css
*/
function colorPickercss()
{
    return '<link rel="stylesheet" href="' . home_base_url("backend/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css") . '">';
}
/*
* for select 2 Js
*/
function select2js()
{
    return '<script src="' . home_base_url('backend/plugins/select2/js/select2.full.min.js') . '" defer></script>';
}
/*
* for select 2 css
*/
function select2css()
{
    return '<link rel="stylesheet" href="' . home_base_url("backend/plugins/select2/css/select2.min.css") . '">';
}
/*
* for check box js
*/
function checkboxjs()
{
    return '<script src="' . home_base_url('backend/js/jquery.checkboxes-1.2.0.min.js') . '" defer></script>';
}
/*
* for datatable css
*/
function datatablecss()
{
    return '
    <link rel="stylesheet" href="' . home_base_url("backend/plugins/datatables/dataTables.bootstrap4.min.css") . '">
    <link rel="stylesheet" href="' . home_base_url("backend/plugins/datatables/responsive.bootstrap4.min.css") . '">
    ';
}
/*
* for datatable js
*/
function datatablejs()
{
    return '
    <script src="' . home_base_url('backend/plugins/datatables/jquery.dataTables.min.js') . '" defer></script>
    <script src="' . home_base_url('backend/plugins/datatables/dataTables.bootstrap4.min.js') . '" defer></script>
    <script src="' . home_base_url('backend/plugins/datatables/dataTables.responsive.min.js') . '" defer></script>
    ';
}

/*
* for datatable js
*/
function ckeditorjs()
{
    return '
        <script src="' . home_base_url('backend/plugins/ckeditor/ckeditor.js') . '" defer></script> 
    ';
}


/*
========================================
for helper permission
=====================================*/
function get_permission_value($datas)
{
    $per = array();
    $permissions  = App\Model\Admin\Permission::select("name")->get();
    foreach ($permissions as $data) {
        $permission =  $data->name;
        $explode = explode('-', $permission);
        foreach ($explode as $value) {
            if ($value == $datas) {
                $per[] = $permission;
            }
        }
    }
    return $per;
}
/*========================================
Upload photo
=====================================*/
function Upload_Image($request, $name, $path, $width = null, $height = null)
{
    if ($request->hasFile($name)) {
        $picture = $request->file($name);
        $images = Image::make($picture);
        if ($width != null && $height == null) {
            $images->fit($width, function ($constraint) {
                $constraint->upsize();
            });
        } else {
            if ($width != null && $height != null) {
                $images->fit($width, $height, function ($constraint) {
                    $constraint->upsize();
                });
            }
        }
        $fileName = pathinfo($name . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
        $images->save($path . $fileName);
        return $fileName;
    }
}
/*========================================
Update photo
=====================================*/
function Update_Upload_Image($request, $name, $model, $path, $width = null, $height = null)
{
    if ($request->hasFile($name)) {
        $file_path = $model->$name;
        $storage_path =  $path . $file_path;
        if (\File::exists($storage_path)) {
            unlink($storage_path);
        }
        $picture = $request->file($name);
        $images = Image::make($picture);
        if ($width != null && $height == null) {
            $images->fit($width, function ($constraint) {
                $constraint->upsize();
            });
        } else {
            if ($width != null && $height != null) {
                $images->fit($width, $height, function ($constraint) {
                    $constraint->upsize();
                });
            }
        }
        $fileName = pathinfo($name . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
        $images->save($path . $fileName);
    } else {
        $fileName = $model[$name];
    }
    return $fileName;
}
/*
* FUNCTION NAME: Senitize Icon
* for replace fontawesome full icon to icon class
* return request class name
* return @values
*/
function senitizeIconData($data)
{
    $doubleCode = strpos($data, '"');
    $singleCode = strpos($data, "'");
    $doubleCodeHtml = strpos($data, '&quot');
    $singleCodeHtml = strpos($data, '&apos');

    if ($doubleCode !== false) {
        $data = str_replace('\\"', '"', $data);
        $data = str_replace('\"', '"', $data);
        $data = explode('"', $data);
        return $data[1];
    } elseif ($singleCode !== false) {
        $data = str_replace('\\"', "'", $data);
        $data = str_replace('\"', "'", $data);
        $data = explode("'", $data);
        return $data[1];
    } elseif ($doubleCodeHtml !== false) {
        $data = str_replace('\\&quot', '"', $data);
        $data = str_replace('\&quot', '"', $data);
        $data = str_replace('\&quot', '"', $data);
        $data = explode('"', $data);
        return $data[1];
    } elseif ($singleCodeHtml !== false) {
        $data = str_replace('\\&apos', "'", $data);
        $data = str_replace('\&apos', "'", $data);
        $data = str_replace('\&apos', "'", $data);
        $data = explode("'", $data);
        return $data[1];
    } else {
        $data = $data;
    }
    return $data; 
}

