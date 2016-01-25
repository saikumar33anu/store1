function priceFlipkart(url) {
 
  if (url !== "") {
 
    try {
 
      /* Extract the HTML source of the Flipkart Page */
      var page = UrlFetchApp.fetch(url).getContentText();
 
      /* Regular Expression to extract Price from the META tag */
      var regex = /<meta[^>]*itemprop\s*=\s*"price"\s*content\s*=\s*"([^"]*)"/gi;
 
      if ((price = regex.exec(page)) !== null) {
 
        regex = /<meta[^>]*name\s*=\s*"og_title".*content\s*=\s*"([^"]*)/gi;           
        title = regex.exec(page);
 
        /* We are using Canonical URL as it containes no tracking parameters */
        regex = /<meta[^>]*name\s*=\s*"og_url".*content\s*=\s*"([^"]*)/gi;           
        canonical = regex.exec(page);
 
        /* The thumbnail image of the Flipkart Product */
        regex = /<meta[^>]*name\s*=\s*"og_image".*content\s*=\s*"([^"]*)/gi;           
        image = regex.exec(page);
 
        if (title && canonical && image) {                
          Logger.log(title[1] + "|" + image[1] + "|" + price[1]);
        } else {
           Logger.log("Could not fetch " + url);
        }          
      }        
    } catch (e) {        
      Logger.log("Flipkart Error: " + e.toString());
    }     
  }
}