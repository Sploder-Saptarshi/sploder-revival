<div class="pagination">
    <?php

  // Define the number of items per page.
  $perPage = 12;

  // Calculate the minimum and maximum offsets.
  $minOffset = 0;
  $maxOffset = ceil($total / $perPage) * $perPage - 1;

  // Get the offset from the GET parameter.
  $offset = isset($_GET['o']) ? (int) $_GET['o'] : $minOffset;

  // Calculate the total number of pages.
  $totalPages = ceil(($maxOffset - $minOffset) / $perPage) + 1;

  // Generate the pagination links.
  $paginationLinks = [];

  for ($i = $totalPages - 2; $i >= 0; $i--) {
    if ($minOffset + $i * $perPage == $_GET['o']) {
      $class = 'span';
    } else {
      $class = 'a';
    }

    $paginationLinks[] = '<' . $class . ' href="?o=' . ($minOffset + $i * $perPage) . '" class="page_button">' . ($i + 1) . '</' . $class . '>';
  }

  // Display the pagination links.
  if ($o / 12 == $totalPages - 2) {
    echo '<span style="width:50px" class="page_button page_next">next &raquo;</span>';
  } else {
    echo '<a class="page_button page_next">next &raquo;</a>';
  }
  echo implode(' ', $paginationLinks);
  if ($o == "0") {
    echo '<span class="page_button page_button_inactive">«</span>';
  } else {
    echo '<a class="page_button">«</a>';
  }


  // Get the objects for the current page.
  $objects = getObjects($offset, $perPage);

  // Display the objects.
  foreach ($objects as $object) {
    // Display the object here.
  }

  // Function to get the total number of items.
  function getTotalItems()
  {
    // TODO: Implement this function to get the total number of items.
  }

  // Function to get the objects for the current page.
  function getObjects($offset, $perPage)
  {
    // TODO: Implement this function to get the objects for the current page.
  }

  ?>
</div>