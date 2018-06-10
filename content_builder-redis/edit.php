<?php global $page;
if ($post->post_name) {
    $pageName = $post->post_name;
} else {
    $pageName = 'index';
}
$themeName = wp_get_theme();
include 'getPageData.php';
$page = getPageData($pageName);
?>
<?php if (is_user_logged_in() && isset($_GET['editable']) && $_GET['editable'] == 'true') { ?>
<div class="edit-overlay"></div>
<div class="edit-ui" id="editUI">
  <div class="edit-ui__slider-control" id="jsControl"></div>
  <h1 class="edit-ui__title">Editable Content</h1>
  <hr>
  <div id="jsdataPointsCont"></div>
  <div class="edit-ui__btn-cont">
    <input type="submit" id="jsSaveAll" value="Save All" class="edit-ui__btn edit-ui__btn--blue ">
    <input type="submit" id="jsPushToProd" value="Export" class="edit-ui__btn edit-ui__btn--white ">
    <input type="submit" id="jsPullFromProd" value="Import" class="edit-ui__btn edit-ui__btn--red">
  </div>
</div>
<style>
  .jsEdit {
    cursor:pointer;
    z-index: 9999!important;
    position: relative;
  }
  .jsEdit:hover {
    outline: 1px solid blue;
  }
  .jsEdit--outline {
    outline: 1px solid blue;
  }

  .input-cont {
    border: solid #FC4C02 1px;
    padding: 10px;
    position: fixed;
    background-color: white;
    z-index:99999;
    box-sizing: border-box;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    top: 0;
    right: 0;
    transition: .5s;
  }
  .input-cont--ui-open {
    width: calc(100% - 300px);
    right: 0;
    transition: .5s;
  }
  .input-cont__title {
    font-weight: 600;
    font-size: 20px;
    cursor: pointer;
    text-transform: capitalize;
    margin: 0 10px 0 0;
    font-family: 'Helvetica';
  }

  .input-cont__textarea {
    width: 100%;
    margin-bottom: 5px;
  }
  .input-cont__save {
    width: 100px;
    border-radius: 10px;
    background-color: cornflowerblue;
    outline: none;
    height: 40px;
    color: white;
    margin: 0 10px 0 0;
  }
  .input-cont__save:hover, .input-cont__save:active {
    background-color: #6495ed8a;
  }
  .input-cont__close {
    width: 100px;
    border-radius: 10px;
    background-color: lightcoral;
    outline: none;
    height: 40px;
    color: white;
  }
  .input-cont__close:hover, .input-cont__close:active {
    background-color: #f0808082
  }
  .edit-ui {
    height: 100%;
    width: 300px;
    position: fixed;
    left: -300px;
    z-index: 9999;
    background-color: white;
    border: solid 1px #FC4C02;;
    top: 0;
    transition: .5s;
    box-sizing: border-box;
    padding: 10px;
    color: #000;
    text-align: center;
    font-family: 'Helvetica'!important;
  }
  .edit-ui--active {
    left: 0;
    transition: .5s;
  }
  .edit-ui__slider-control {
    width: 20px;
    height: 40px;
    background-color: #FC4C02;;
    position: absolute;
    right: -20px;
    z-index: -222;
    top: 50%;
    transform: translate(0, -50%);
    border-top-right-radius: 40px;
    border-bottom-right-radius: 40px;
    cursor: pointer;
    transition: .5s;
  }
  .edit-ui__slider-control:hover {
    height: 65px;
    width: 45px;
    right: -45px;
    transition: .5s;
  }
  .edit-ui__title {
    font-weight: 600;
    color: #000;
    font-family: 'Helvetica'!important;
  }
  .edit-ui__label {
    font-weight: 600;
    font-size: 20px;
    cursor: pointer;
    display: inline;
    text-transform: capitalize;
    font-family: 'Helvetica'!important;
  }
  .edit-ui__accordion {
    display: none;
  }
  .show {
    display: block;
  }
  .edit-ui__flex {
    display: flex;
    justify-content: space-between;
    cursor: pointer;
  }
  .edit-ui__input {
    width: 100%;
    resize: vertical;
    min-height: 50px;
    border: solid 1px black;
    font-family: 'Helvetica'!important;
  }
  .edit-ui__save-one {
    width: 100%;
    border-radius: 10px;
    background-color: cornflowerblue;
    outline: none;
    height: 40px;
    color: white;
    margin-bottom: 5px;
    font-family: 'Helvetica'!important;
  }
  .edit-ui__sync {
    display: inline-block;
    border-radius: 10px;
    padding: 2px 5px;
    margin: 2px 0 2px 5px;
    width: 131px;
    text-align: center;
    font-family: 'Helvetica'!important;
  }
  .edit-ui__sync--sync {
    background-color: lightblue;
    color: white;
  }
  .edit-ui__sync--newer {
    background-color: green;
    color: white;
  }
  .edit-ui__sync--old {
    background-color: red;
    color: white;
  }
  .edit-ui__sync--new {
    background-color: orange;
    color: white;
  }
  .edit-ui__btn-cont {
    position: fixed;
    bottom: 10px;
    display: flex;
    width: 275px;
    justify-content: space-between;
  }
  .edit-ui__btn {
    width: 30%;
    border-radius: 10px;
    background-color: white;
    outline: none;
    height: 40px;
    color: white;
    font-family: 'Helvetica'!important;
  }
  .edit-ui__btn--blue {
    background-color: cornflowerblue;
  }
  .edit-ui__btn--blue:hover, .edit-ui__btn--blue:active {
    background-color: #6495ed8a;
  }
  .edit-ui__btn--white {
    color: black;
  }
  .edit-ui__btn--white:hover, .edit-ui__btn--white:active {
    opacity: .5;
  }
  .edit-ui__btn--red {
    background-color: lightcoral;
  }
  .edit-ui__btn--red:hover, .edit-ui__btn--red:active {
    background-color: #f0808082
  }
</style>
<script>var siteNameSpace ='<?php echo $themeName . '_' . $pageName ?>';</script>
<script src="/wp-content/themes/global-theme-assets/content_builder/edit.js"></script>

<?php } ?>