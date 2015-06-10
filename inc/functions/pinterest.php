


<?php
/*
 When viewing items in lists, the API defaults to a summary of relevant fields. This is a subset of the fields that you'll see when viewing a single item. When viewing an item in isolation, you'll see all of the fields associated with that item.
Specifying response fields
You can select a subset of fields to return on a type. The syntax follows:
                fields=pin.first_name,pin.last_name
            In the above example, pins will only include first_name and last_name. 
            

Adding fields to a summary

You can customize the fields in a specific response type, by using the add_fields parameter to augment the default field list with any field you specify.

For example, If you want to add the first_name field to a pin, do the following: add_fields=pin.first_name You can add several fields to several object types as well: add_fields=pin.first_name,pin.last_name,board.title


Images

Some return types have an images attribute. This attribute is not included as part of a summary view, and must be specifically requested. However, sending back all the images would be overkill for most instances, so when you request this field, you must provide all of the image keys you require.

An image key is just the width and height of an image joined by an 'x'. For example: 64x64. Some keys specify only the width, since the height will be affected by the aspect ratio of the original image. For images of this type, only the width is provided, like 1200x.

To request multiple images, use the following syntax:
pin.images=[136x136,236x,1200x] 


Bookmarks
For some queries that return long lists of items, the API will respond with a bookmark. Echoing this bookmark back to the same call on a subsequent request will resume where you left off.
                bookmark=<really long string>
            
Response types
Appending a query string param of 'callback' will make the API respond with jsonp wrapped in a function call. The function's name is the value of the callback parameter. 




GET /v3/domains/<domain>/pins/top/clicks/ 

Parameters
Name 	Description 	Type 	Required?
domain 	The domain name to query. The calling client must be authorized to view this domain
	A valid domain name 	Yes
end_date 	The end of the period to show pins for.
	A date string in the format YYYY-mm-dd 	Yes 

	dus http://api.pinterest.com/v3/domains/d0ms_007/pins/top/clicks/?end_date=2000-01-01

            */



?>