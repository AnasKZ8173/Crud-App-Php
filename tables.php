<?php

include 'components/sidenav.php';
include 'components/nav.php';

include 'config.php';
?>


<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Products table</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">category</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">price</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">post Date</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>

                <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {

                ?>

                    <tr data-id="<?php echo $row['id']; ?>">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="./images/<?php echo $row['p_image']; ?>" class="avatar avatar-sm me-3" alt="product image">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['p_name']; ?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['p_category']; ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success"><?php echo $row['p_price']; ?>$</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['postDate']; ?></span>
                        <span class="d-none p-desc"><?php echo $row['p_desc']; ?></span>
                      </td>
                      <td class="align-middle d-flex gap-3">
                        <form action="productslogic.php" method="post" onsubmit="return confirm('you want to delete this product');">
                          <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
                          <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                        </form>
                        <button class="btn btn-primary update-btn">Update</button>
                      </td>
                    </tr>


                <?php
                  }
                } else {
                  echo "No products found.";
                }

                mysqli_close($conn);






                ?>






                <!-- Modal -->
                <div id="updateModal" class="modal">
                  <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <form id="updateProductForm" action="productslogic.php" method="POST">
                      <input type="hidden" id="productId" name="productId">
                      <div class="mb-1">
                        <label for="productName" class="form-label text-white">Product Name</label>
                        <input type="text" name="productName" id="productName" class="form-control" required>
                        <small class="text-danger" id="productNameError"></small>
                      </div>
                      <div class="mb-1">
                        <label for="productDescription" class="form-label text-white">Description</label>
                        <textarea name="productDescription" id="productDescription" class="form-control" required></textarea>
                        <small class="text-danger" id="productDescriptionError"></small>
                      </div>
                      <div class="mb-1">
                        <label for="productPrice" class="form-label text-white">Price</label>
                        <input type="number" name="productPrice" id="productPrice" class="form-control" required>
                        <small class="text-danger" id="productPriceError"></small>
                      </div>
                      <div class="mb-3">
                        <label for="productCategory" class="form-label text-white">Category</label>
                        <select name="productCategory" id="productCategory" class="form-control" required>
                          <option value="">Select Category</option>
                          <option value="Electronics">Electronics</option>
                          <option value="Clothing">Clothing</option>
                          <option value="Accessories">Accessories</option>
                        </select>
                        <small class="text-danger" id="productCategoryError"></small>
                      </div>
                      <button type="submit" name="update" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                  </div>
                </div>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var modal = document.getElementById("updateModal");
      var closeModalBtn = document.getElementsByClassName("close-btn")[0];
      var updateProductForm = document.getElementById('updateProductForm');


      document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('update-btn')) {
          var row = event.target.closest('tr');
          var productId = row.getAttribute('data-id');
          var productName = row.querySelector('h6.mb-0').innerText;
          var productCategory = row.querySelector('p.text-xs').innerText;
          var productPrice = row.querySelector('span.badge').innerText.replace('$', '');
          var productDescription = row.querySelector('.p-desc').innerText;


          document.getElementById('productId').value = productId;
          document.getElementById('productName').value = productName;
          document.getElementById('productDescription').value = productDescription;
          document.getElementById('productPrice').value = productPrice;
          document.getElementById('productCategory').value = productCategory;

          modal.style.display = "block";
        }
      });


      closeModalBtn.onclick = function() {
        modal.style.display = "none";
      };


      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };


    });



    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      };
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>



  <?php
  include 'components/footer.php';
  ?>