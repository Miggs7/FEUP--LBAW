function search() {
    // Declare variables
    let input, filter,cards,titles,rows;
    input = document.getElementById("search-bar");
    filter = input.value.toUpperCase();
    cards = document.getElementsByClassName("card-container");
    titles = document.getElementsByClassName("auctionName");
    rows = document.getElementsByClassName("row");
    console.log(titles);
  
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < cards.length; i++) {
      if (titles[i].innerHTML.toUpperCase().includes(filter) ) {
        cards[i].style.display = "block";
      } else {
        cards[i].style.display = "none";
      }
    }
  }

  