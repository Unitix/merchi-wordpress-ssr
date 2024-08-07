let offset = 0;
let loadingData = false;
let hasMoreProducts = true;
let currentRequest = null;
var domainId = scriptData.merchi_domain;
// console.log(domainId);
const selectedValueDisplay = document.getElementById("selected_value_display");
const customValueField = document.getElementById("custom_value_field");
const searchIcon = document.querySelector(".search-icon");
const searchResults = document.getElementById("search_results");
function handleInput() {
  clearTimeout(jQuery.data(this, "timer"));
  const dropdownContent = jQuery("#search_results");
  dropdownContent.html("");
  dropdownContent.hide();
  const timeout = setTimeout(function () {
    offset = 0; // Reset offset when user starts typing
    hasMoreProducts = true;
    fetchProducts(); // Call the function to fetch products
  }, 500);
  jQuery(this).data("timer", timeout);
}

function searchProductsByTerm(products, searchTerm) {
  searchTerm = searchTerm.toLowerCase();
  let foundProducts = [];

  for (let i = 0; i < products.length; i++) {
    const productName = products[i].product.name.toLowerCase();
    if (productName.includes(searchTerm)) {
      const { id, name, bestPrice } = products[i].product;
      const prod = {
        id: id,
        name: name,
        bestPrice: bestPrice,
      };
      foundProducts.push(prod);
    }
  }
  return foundProducts;
}

function fetchProducts() {
  const cstloader = jQuery(".cst-loader");
  const searchIcon = jQuery(".search-icon");
  cstloader.show();
  searchIcon.hide();
  const limit = 1000;
  const apiKey = scriptData.merchi_secret;
  const apiUrl = `${scriptData.merchi_url}/v6/products/?apiKey=${apiKey}&inDomain=${domainId}&limit=${limit}&offset=${offset}`;
  const searchTerm = jQuery("#custom_value_field").val();

  if (loadingData || !hasMoreProducts) {
    return;
  }

  if (currentRequest) {
    currentRequest.abort(); // Abort the previous request
  }

  currentRequest = jQuery.ajax({
    url: apiUrl,
    type: "GET",
    beforeSend: function () {
      loadingData = true;
    },
    success: function (response) {
      if (response.products.length > 0) {
        const dropdownContent = jQuery("#search_results");

        const foundProds = searchProductsByTerm(response.products, searchTerm);
        foundProds.forEach((product) => {
          const productName = product.name;
          const div = jQuery("<div>");
          div.text(productName);
          div.addClass("search-result");
          div.on("click", function () {
            jQuery("#custom_value_field").val(productName);
			jQuery("#merchi_id").val(product.id);
			jQuery("#selected_value_display h3").html(productName);
			jQuery("#selected_value_display h3").css({"display":"inline-block"});
			jQuery("#custom_value_field").css({"display":"inline-block"});
            dropdownContent.hide();
          });
          dropdownContent.append(div);
        });
        cstloader.hide();
        searchIcon.show();
        dropdownContent.show();

        offset += limit;
      } else {
        hasMoreProducts = false; // Set flag to false if no more products
      }
    },
    complete: function () {
      loadingData = false;
    },
    error: function (error) {
      console.error("Error fetching products:", error);
    },
  });
}
jQuery(document).ready(function ($) {
	jQuery("#custom_value_field").on("input", handleInput);
	jQuery("#search_results").on("scroll", function () {
		const contentHeight = this.scrollHeight;
		const visibleHeight = this.clientHeight;
		const scrollPosition = this.scrollTop;

		if (contentHeight - (scrollPosition + visibleHeight) < 100) {
			fetchProducts();
		}
	});

	  jQuery(document).on("click", function (event) {
		const searchResults = jQuery("#search_results");
		const customValueField = jQuery("#custom_value_field");

		// Check if the click is outside the search results and custom value field
		if (
		!searchResults.is(event.target) &&
		!customValueField.is(event.target) &&
		searchResults.has(event.target).length === 0
		) {
		searchResults.hide(); // Close the dropdown
		}
	});
});