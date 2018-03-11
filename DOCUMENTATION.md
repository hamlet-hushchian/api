# Books API

Provides API inteface for books collection.

## API location

[some-api.website](http://some-api.website/)

## Resources:

* **/books** - Provides access to books collection
* **/authors** - Provide access to authors collection
* **/authors/{authorId}/books** - Author books collection

## Available params:

* **limit** - Limit collection output
* **offset** - Offset collection output

This parameters can be specified using GET params while querying resource

## General API response format:

``` json
{
  "status": "OK",
  "message": "Ok",
  "data": {
    // ... 
    "limit": 0,
    "offset": 0,
    "rows": 20
  }
}
```

#### Parameters:
- **status** - Indicates status of request
- **message** - Human readable description of status
- **data** - Resource specific response data
    - 'limit' - requested limit parameter
    - 'offset' - requested offset parameter
    - 'rows' - collection total length (before limit and offset parameters being applyed)

#### Possible statuses:
- **OK** - Request was sucessfully processed
- **INVALID_REQUEST** - Some errors with request format (described in 'message' response parameter)
- **NOT_FOUND** - Returned if some requested entity does not exist (see 'message' response parameter)

## Request examples

### Books:
#### Request:

    GET /books?limit=2

#### Response:
``` json
{
  "status": "OK",
  "message": "Ok",
  "data": {
    "books": [
      {
        "id": 1,
        "title": "Cryptonomicon",
        "author": {
          "id": 1,
          "name": "Nil Stevenson"
        }
      },
      {
        "id": 2,
        "title": "Snow Crash",
        "author": {
          "id": 1,
          "name": "Nil Stevenson"
        }
      }
    ],
    "limit": 2,
    "offset": 0,
    "rows": 10
  }
}
```

### Authors:
#### Request:

    GET /authors

#### Response:
``` json
{
  "status": "OK",
  "message": "Ok",
  "data": {
    "authors": [
      {
        "id": 1,
        "name": "Nil Stevenson"
      },
      {
        "id": 2,
        "name": "William Gibson"
      }
    ],
    "limit": 0,
    "offset": 0,
    "rows": 2
  }
}
```

### Books filtered by author:
#### Request:

    GET /authors/1/books?limit=2

#### Response:
``` json
{
  "status": "OK",
  "message": "Ok",
  "data": {
    "books": [
      {
        "id": 1,
        "title": "Cryptonomicon",
        "author": {
          "id": 1,
          "name": "Nil Stevenson"
        }
      },
      {
        "id": 2,
        "title": "Snow Crash",
        "author": {
          "id": 1,
          "name": "Nil Stevenson"
        }
      }
    ],
    "limit": 2,
    "offset": 0,
    "rows": 6
  }
}
```
