function search() {
    // Declare variables
    let input, filter,cards,titles;
    input = document.getElementById("search-bar");
    filter = input.value.toUpperCase();
    cards = document.getElementsByClassName("card")
    titles = document.getElementsByClassName("auctionName");
  
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < cards.length; i++) {
      if (titles[i].innerHTML.toUpperCase().includes(filter) ) {
        cards[i].style.display = "block";
      } else {
        cards[i].style.display = "none";
      }
    }
  }