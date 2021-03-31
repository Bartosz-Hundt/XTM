
<div class="wrap">
<h1>Translations</h1>
<?php settings_errors();
$listlanguages = $GLOBALS['polylang']->model->get_languages_list();
?>



<ul class="nav-tabs">
  <li class="active"><a href="#tab-1">Polylang table</a></li>
  <li><a href="#tab-2">List</a></li>
</ul>

<div class="tab-content">
  <div id="tab-1" class="tab-pane active">

    <h3>Manage Your Texts</h3>

    <?php
      $data = PLL_Admin_Strings::get_strings();

      $selected = empty($_REQUEST['group']) ? -1 : $_REQUEST['group'];

      foreach ($data as $key=>$row) {
        $groups[] = $row['context']; // get the groups

        // filter for search string
        if (($selected !=-1 && $row['context'] != $selected) || (!empty($_REQUEST['s']) && stripos($row['name'], $_REQUEST['s']) === false && stripos($row['string'], $_REQUEST['s']) === false))
        unset ($data[$key]);
      }

      $groups = array_unique($groups);

      // load translations
      foreach ($listlanguages as $language) {
      // filters by language if requested
        if (($lg = get_user_meta(get_current_user_id(), 'pll_filter_content', true)) && $language->slug != $lg)
        continue;

        $mo = new PLL_MO();
        $mo->import_from_db($language);
        foreach ($data as $key=>$row) {
          $data[$key]['translations'][$language->slug] = $mo->translate($row['string']);
          $data[$key]['row'] = $key; // store the row number for convenience
        }
      }



    // get an array with language slugs as keys, names as values
    $languages = array_combine(wp_list_pluck($listlanguages, 'slug'), wp_list_pluck($listlanguages, 'name'));

    $string_table = new Lingotek_Table_String(compact('languages', 'groups', 'selected'));
    $string_table->prepare_items($data); ?>

    <div class="form-wrap">
       <form id="string-translation" method="post" action="admin.php?page=mlang&amp;tab=strings&amp;noheader=true">
          <input type="hidden" name="pll_action" value="string-translation" />
            <?php
          $string_table->search_box(__('Search translations', 'wp-lingotek'), 'translations' );
          wp_nonce_field('string-translation', '_wpnonce_string-translation');
          $string_table->display();
            ?>
       </form>
    </div>
  </div>

  <div id="tab-2" class="tab-pane">
    <form method="post" action="options.php">
      <?php
      $options = get_option('xtm_plugin_translation');
      echo '<table class="translation-table"><tr><th>Selected Content</th><th class="text-center">Actions</th></tr>';

      foreach ($data as $key=>$row) {
        echo "<tr>
        <td>{$row['string']}</td>
        <td class=\"text-center\"><a href=\"#\">EDIT</a> - <a href=\"#\">DELETE</a></td>
            </tr>";
      }
      echo '</table>';
        ?>
        <h3 class="status">Status = <span id="Status">Ready</span></h3>
        <h3 class="request"><div onclick="change_text()">Request professional translation</div></h3>
<?php
$STATUS = "Sent";

  echo '<script>
        function change_text()
        {
            if(document.getElementById("Status").innerHTML=="Ready")
            {
                document.getElementById("Status").innerHTML="' . $STATUS . '";
            }
            else
            {
                document.getElementById("Status").innerHTML="Ready";
            }
        }
  </script>';

?>
    </form>
  </div>

</div>
</div>
