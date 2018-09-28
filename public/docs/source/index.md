---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8888/docs/collection.json)

<!-- END_INFO -->

#Auth
<!-- START_3157fb6d77831463001829403e201c3e -->
## Register new user in the application

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/auth/register" \
-H "Accept: application/json" \
    -d "email"="richie31@example.net" \
    -d "password"="ut" \
    -d "first_name"="ut" \
    -d "last_name"="ut" \
    -d "phone_number"="ut" \
    -d "avatar"="http://www.hilpert.net/qui-nobis-vel-aut-quaerat-et.html" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/auth/register",
    "method": "POST",
    "data": {
        "email": "richie31@example.net",
        "password": "ut",
        "first_name": "ut",
        "last_name": "ut",
        "phone_number": "ut",
        "avatar": "http:\/\/www.hilpert.net\/qui-nobis-vel-aut-quaerat-et.html"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/auth/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | 
    password | string |  required  | Minimum: `6`
    first_name | string |  optional  | Maximum: `255`
    last_name | string |  optional  | Maximum: `255`
    phone_number | string |  optional  | 
    avatar | url |  optional  | 

<!-- END_3157fb6d77831463001829403e201c3e -->

<!-- START_2be1f0e022faf424f18f30275e61416e -->
## Log user into the application.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/auth/login" \
-H "Accept: application/json" \
    -d "email"="wisoky.glennie@example.net" \
    -d "password"="magni" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/auth/login",
    "method": "POST",
    "data": {
        "email": "wisoky.glennie@example.net",
        "password": "magni"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/auth/login`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Valid user email
    password | string |  required  | 

<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_1c1379ad98c1e4337433460cbb47992e -->
## Refresh user OAuth (Bearer) token.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/auth/refresh" \
-H "Accept: application/json" \
    -d "refresh_token"="hic" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/auth/refresh",
    "method": "POST",
    "data": {
        "refresh_token": "hic"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/auth/refresh`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    refresh_token | string |  required  | 

<!-- END_1c1379ad98c1e4337433460cbb47992e -->

<!-- START_715f1d73092629748c4397de566ea310 -->
## Log the user out of the application (using GET method).

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/auth/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/auth/logout",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/auth/logout`


<!-- END_715f1d73092629748c4397de566ea310 -->

<!-- START_a68ff660ea3d08198e527df659b17963 -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/auth/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/auth/logout",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->

<!-- START_823c3f3bc0a262b227a58aca2dd2e5f5 -->
## Show the authenticated user.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/auth/me" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/auth/me",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/auth/me`


<!-- END_823c3f3bc0a262b227a58aca2dd2e5f5 -->

#Email: Emails
<!-- START_2c947e09e8f55cdb96a900368b15c0de -->
## Send contact message

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/send-contact" \
-H "Accept: application/json" \
    -d "from-email"="oconnell.amiya@example.com" \
    -d "from-name"="ut" \
    -d "subject"="ut" \
    -d "message"="ut" \
    -d "reason"="ut" \
    -d "attachment"="ut" \
    -d "phone-number"="ut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/send-contact",
    "method": "POST",
    "data": {
        "from-email": "oconnell.amiya@example.com",
        "from-name": "ut",
        "subject": "ut",
        "message": "ut",
        "reason": "ut",
        "attachment": "ut",
        "phone-number": "ut"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/send-contact`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    from-email | email |  required  | 
    from-name | string |  optional  | 
    subject | string |  optional  | 
    message | string |  required  | Minimum: `50`
    reason | string |  required  | 
    attachment | file |  optional  | Must be a file upload
    phone-number | string |  optional  | 

<!-- END_2c947e09e8f55cdb96a900368b15c0de -->

<!-- START_ccc7ce6e54464417f55e4bcd112a7e80 -->
## Send an email.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/send" \
-H "Accept: application/json" \
    -d "email"="hic" \
    -d "message"="hic" \
    -d "options"="hic" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/send",
    "method": "POST",
    "data": {
        "email": "hic",
        "message": "hic",
        "options": "hic"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/send`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | array |  required  | 
    message | array |  optional  | 
    options | array |  optional  | 

<!-- END_ccc7ce6e54464417f55e4bcd112a7e80 -->

#Email: Lists
<!-- START_11b13f488b6677f1fbfbbdf3480082ed -->
## Get all email lists.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/email/lists" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/email/lists`


<!-- END_11b13f488b6677f1fbfbbdf3480082ed -->

<!-- START_a8f5a12edb923dc3c0c54fb4365b333a -->
## Get a specific email list.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/email/lists/{list}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/{list}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/email/lists/{list}`


<!-- END_a8f5a12edb923dc3c0c54fb4365b333a -->

<!-- START_9068f8a6416af5fb9991a7797d9d7368 -->
## Create email list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/lists" \
-H "Accept: application/json" \
    -d "name"="corrupti" \
    -d "description"="corrupti" \
    -d "emails"="corrupti" \
    -d "slug"="corrupti" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists",
    "method": "POST",
    "data": {
        "name": "corrupti",
        "description": "corrupti",
        "emails": "corrupti",
        "slug": "corrupti"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/lists`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `255`
    description | string |  required  | Maximum: `255`
    emails | string |  required  | Maximum: `255`
    slug | string |  required  | Maximum: `255`

<!-- END_9068f8a6416af5fb9991a7797d9d7368 -->

<!-- START_d054f796cbc7bbe86c4a3b04dbf24e81 -->
## Update email list.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/email/lists/{list}" \
-H "Accept: application/json" \
    -d "name"="perspiciatis" \
    -d "description"="perspiciatis" \
    -d "emails"="perspiciatis" \
    -d "slug"="perspiciatis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/{list}",
    "method": "PUT",
    "data": {
        "name": "perspiciatis",
        "description": "perspiciatis",
        "emails": "perspiciatis",
        "slug": "perspiciatis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/email/lists/{list}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | Maximum: `255`
    description | string |  optional  | Maximum: `255`
    emails | string |  optional  | Maximum: `255`
    slug | string |  optional  | Maximum: `255`

<!-- END_d054f796cbc7bbe86c4a3b04dbf24e81 -->

<!-- START_d3728865986de9440bedf79c59fb82b5 -->
## Bulk update to email lists.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/lists/update" \
-H "Accept: application/json" \
    -d "attributes"="earum" \
    -d "id"="earum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/update",
    "method": "POST",
    "data": {
        "attributes": "earum",
        "id": "earum"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/lists/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_d3728865986de9440bedf79c59fb82b5 -->

<!-- START_812e836e46b8df325e144f6d5119e2e6 -->
## Delete email list.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/email/lists/{list}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/{list}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/email/lists/{list}`


<!-- END_812e836e46b8df325e144f6d5119e2e6 -->

<!-- START_b080f511459d90fcf1bb2de0b07ca30c -->
## Bulk delete to email lists.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/lists/delete" \
-H "Accept: application/json" \
    -d "id"="est" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/delete",
    "method": "POST",
    "data": {
        "id": "est"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/lists/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_b080f511459d90fcf1bb2de0b07ca30c -->

<!-- START_8a8ca311b8338f082a3d5c38ac77d6f0 -->
## Restore email list.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/email/lists/{list}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/{list}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/email/lists/{list}`


<!-- END_8a8ca311b8338f082a3d5c38ac77d6f0 -->

<!-- START_79190a42143a94590c29dfa4009bb4c3 -->
## Bulk update to email lists.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/lists/restore" \
-H "Accept: application/json" \
    -d "id"="voluptate" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/restore",
    "method": "POST",
    "data": {
        "id": "voluptate"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/lists/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_79190a42143a94590c29dfa4009bb4c3 -->

<!-- START_11085a9a7d8b87f26a898c2f61ed997c -->
## Search &amp; list email lists.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (lists with name like %-admin) OR (display_name like % Admin)
   - name : '%-admin' : like | or @ key : '% Admin' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/lists/search" \
-H "Accept: application/json" \
    -d "options"="et" \
    -d "options.id"="et" \
    -d "options.columns"="et" \
    -d "options.order"="et" \
    -d "options.limit"="1781" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="et" \
    -d "options.scope"="et" \
    -d "options.relationships"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/search",
    "method": "POST",
    "data": {
        "options": "et",
        "options.id": "et",
        "options.columns": "et",
        "options.order": "et",
        "options.limit": 1781,
        "options.no-paginate": true,
        "options.condition": "et",
        "options.scope": "et",
        "options.relationships": "et"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/lists/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_11085a9a7d8b87f26a898c2f61ed997c -->

<!-- START_88db7647fdb9f6d996159dd1a50d3d34 -->
## Get email lists as option list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/lists/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/lists/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/lists/list-options`


<!-- END_88db7647fdb9f6d996159dd1a50d3d34 -->

#Email: Templates
<!-- START_7e9d609353f7efcebade60ec24cc1720 -->
## Get all email templates.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/email/templates" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/email/templates`


<!-- END_7e9d609353f7efcebade60ec24cc1720 -->

<!-- START_04e2fb603a663d322be20d54c02c217d -->
## Get a specific email template.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/email/templates/{template}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/{template}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/email/templates/{template}`


<!-- END_04e2fb603a663d322be20d54c02c217d -->

<!-- START_a7935c72a1104f1bec248e70d02b3ecc -->
## Create email template.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/templates" \
-H "Accept: application/json" \
    -d "name"="non" \
    -d "type"="non" \
    -d "path"="non" \
    -d "fields"="non" \
    -d "description"="non" \
    -d "format"="non" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates",
    "method": "POST",
    "data": {
        "name": "non",
        "type": "non",
        "path": "non",
        "fields": "non",
        "description": "non",
        "format": "non"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/templates`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `255`
    type | string |  optional  | Maximum: `255`
    path | string |  required  | Maximum: `255`
    fields | string |  required  | Maximum: `255`
    description | string |  required  | Maximum: `255`
    format | string |  optional  | Maximum: `255`

<!-- END_a7935c72a1104f1bec248e70d02b3ecc -->

<!-- START_f363cb6352e91f1b5719d5ed57c94f27 -->
## Update email template.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/email/templates/{template}" \
-H "Accept: application/json" \
    -d "name"="a" \
    -d "type"="a" \
    -d "path"="a" \
    -d "fields"="a" \
    -d "description"="a" \
    -d "format"="a" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/{template}",
    "method": "PUT",
    "data": {
        "name": "a",
        "type": "a",
        "path": "a",
        "fields": "a",
        "description": "a",
        "format": "a"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/email/templates/{template}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | Maximum: `255`
    type | string |  optional  | Maximum: `255`
    path | string |  optional  | Maximum: `255`
    fields | string |  optional  | Maximum: `255`
    description | string |  optional  | Maximum: `255`
    format | string |  optional  | Maximum: `255`

<!-- END_f363cb6352e91f1b5719d5ed57c94f27 -->

<!-- START_052b46b0ad5256cc414399ebf6e320a6 -->
## Bulk update to email templates.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/templates/update" \
-H "Accept: application/json" \
    -d "attributes"="asperiores" \
    -d "id"="asperiores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/update",
    "method": "POST",
    "data": {
        "attributes": "asperiores",
        "id": "asperiores"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/templates/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_052b46b0ad5256cc414399ebf6e320a6 -->

<!-- START_d6cfbbc1f342288bf82d3d9bd41aae67 -->
## Delete email template.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/email/templates/{template}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/{template}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/email/templates/{template}`


<!-- END_d6cfbbc1f342288bf82d3d9bd41aae67 -->

<!-- START_a317806f4f1f040f3cf8ca86dcbf215f -->
## Bulk delete to email templates.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/templates/delete" \
-H "Accept: application/json" \
    -d "id"="a" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/delete",
    "method": "POST",
    "data": {
        "id": "a"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/templates/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_a317806f4f1f040f3cf8ca86dcbf215f -->

<!-- START_a6601bddf43117e3b791e631d6823610 -->
## Restore email template.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/email/templates/{template}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/{template}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/email/templates/{template}`


<!-- END_a6601bddf43117e3b791e631d6823610 -->

<!-- START_32aee2f8f6353df7e06218048bb23db3 -->
## Bulk restore to email templates.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/templates/restore" \
-H "Accept: application/json" \
    -d "id"="est" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/restore",
    "method": "POST",
    "data": {
        "id": "est"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/templates/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_32aee2f8f6353df7e06218048bb23db3 -->

<!-- START_67924f562cb498b10a05886a7e3db821 -->
## Search &amp; list email templates.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (templates with name like %-admin) OR (display_name like % Admin)
   - name : '%-admin' : like | or @ key : '% Admin' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/templates/search" \
-H "Accept: application/json" \
    -d "options"="doloribus" \
    -d "options.id"="doloribus" \
    -d "options.columns"="doloribus" \
    -d "options.order"="doloribus" \
    -d "options.limit"="861120254" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="doloribus" \
    -d "options.scope"="doloribus" \
    -d "options.relationships"="doloribus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/search",
    "method": "POST",
    "data": {
        "options": "doloribus",
        "options.id": "doloribus",
        "options.columns": "doloribus",
        "options.order": "doloribus",
        "options.limit": 861120254,
        "options.no-paginate": true,
        "options.condition": "doloribus",
        "options.scope": "doloribus",
        "options.relationships": "doloribus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/templates/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_67924f562cb498b10a05886a7e3db821 -->

<!-- START_92545a8c0a9cf075a49491b506af84d6 -->
## Get email templates as option list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/templates/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/templates/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/templates/list-options`


<!-- END_92545a8c0a9cf075a49491b506af84d6 -->

#Email: Types
<!-- START_c46f48a1c8937c71b84982ce70b26bdc -->
## Get all email types.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/email/types" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/email/types`


<!-- END_c46f48a1c8937c71b84982ce70b26bdc -->

<!-- START_8811474584e6ab824cb7547e82fca986 -->
## Get a specific email type.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/email/types/{type}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/{type}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/email/types/{type}`


<!-- END_8811474584e6ab824cb7547e82fca986 -->

<!-- START_dad9ec3ec47da5c7d066eb501856383f -->
## Create email type.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/types" \
-H "Accept: application/json" \
    -d "name"="aut" \
    -d "description"="aut" \
    -d "slug"="aut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types",
    "method": "POST",
    "data": {
        "name": "aut",
        "description": "aut",
        "slug": "aut"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/types`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `255`
    description | string |  required  | Maximum: `255`
    slug | string |  required  | Maximum: `255`

<!-- END_dad9ec3ec47da5c7d066eb501856383f -->

<!-- START_884843e442e55b81ff02c7016f6d2a08 -->
## Update email type.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/email/types/{type}" \
-H "Accept: application/json" \
    -d "name"="perspiciatis" \
    -d "description"="perspiciatis" \
    -d "slug"="perspiciatis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/{type}",
    "method": "PUT",
    "data": {
        "name": "perspiciatis",
        "description": "perspiciatis",
        "slug": "perspiciatis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/email/types/{type}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | Maximum: `255`
    description | string |  optional  | Maximum: `255`
    slug | string |  optional  | Maximum: `255`

<!-- END_884843e442e55b81ff02c7016f6d2a08 -->

<!-- START_d1ffb87181deaa48bb218b0b7e4d0029 -->
## Bulk update to email types.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/types/update" \
-H "Accept: application/json" \
    -d "attributes"="quisquam" \
    -d "id"="quisquam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/update",
    "method": "POST",
    "data": {
        "attributes": "quisquam",
        "id": "quisquam"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/types/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_d1ffb87181deaa48bb218b0b7e4d0029 -->

<!-- START_4ac5268723fce412d942413b3cc27b01 -->
## Delete email type.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/email/types/{type}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/{type}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/email/types/{type}`


<!-- END_4ac5268723fce412d942413b3cc27b01 -->

<!-- START_40c6e7ea6d1f78bd83484daaa5fd9cb0 -->
## Bulk delete to email types.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/types/delete" \
-H "Accept: application/json" \
    -d "id"="labore" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/delete",
    "method": "POST",
    "data": {
        "id": "labore"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/types/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_40c6e7ea6d1f78bd83484daaa5fd9cb0 -->

<!-- START_38818d59776bb5d22e9a989d4f724e3a -->
## Restore email type.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/email/types/{type}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/{type}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/email/types/{type}`


<!-- END_38818d59776bb5d22e9a989d4f724e3a -->

<!-- START_5232bde9d5e55b86c0cc2fcb2bd2625b -->
## Bulk restore to email types.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/types/restore" \
-H "Accept: application/json" \
    -d "id"="ipsam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/restore",
    "method": "POST",
    "data": {
        "id": "ipsam"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/types/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_5232bde9d5e55b86c0cc2fcb2bd2625b -->

<!-- START_8a3c9cec2446ca4fb39310c695e2177e -->
## Search &amp; list email types.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (types with name like %-admin) OR (display_name like % Admin)
   - name : '%-admin' : like | or @ key : '% Admin' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/types/search" \
-H "Accept: application/json" \
    -d "options"="minus" \
    -d "options.id"="minus" \
    -d "options.columns"="minus" \
    -d "options.order"="minus" \
    -d "options.limit"="6416570" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="minus" \
    -d "options.scope"="minus" \
    -d "options.relationships"="minus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/search",
    "method": "POST",
    "data": {
        "options": "minus",
        "options.id": "minus",
        "options.columns": "minus",
        "options.order": "minus",
        "options.limit": 6416570,
        "options.no-paginate": true,
        "options.condition": "minus",
        "options.scope": "minus",
        "options.relationships": "minus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/types/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_8a3c9cec2446ca4fb39310c695e2177e -->

<!-- START_a7b7239f9ef37833a145bf8d23ccd5d5 -->
## Get email types as option list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/email/types/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/email/types/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/email/types/list-options`


<!-- END_a7b7239f9ef37833a145bf8d23ccd5d5 -->

#File: Files
<!-- START_585ca16a2f5cfde4100751ef1bdc9d96 -->
## Get all files.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/files" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/files`


<!-- END_585ca16a2f5cfde4100751ef1bdc9d96 -->

<!-- START_a3dc4d54f544a68b1cc0c86f1999a3c7 -->
## Get a specific file.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/files/{file}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/{file}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/files/{file}`


<!-- END_a3dc4d54f544a68b1cc0c86f1999a3c7 -->

<!-- START_ac93ed9799eefd97270c4b7120e24638 -->
## Create file.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files" \
-H "Accept: application/json" \
    -d "file"="quas" \
    -d "name"="quas" \
    -d "path"="quas" \
    -d "disk"="public" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files",
    "method": "POST",
    "data": {
        "file": "quas",
        "name": "quas",
        "path": "quas",
        "disk": "public"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    file | string |  required  | 
    name | string |  optional  | Maximum: `255`
    path | string |  optional  | Maximum: `255`
    disk | string |  optional  | `s3`, `public` or `local`

<!-- END_ac93ed9799eefd97270c4b7120e24638 -->

<!-- START_30d9bdafd8084f3ef40f4a7659a47cac -->
## Update file.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/files/{file}" \
-H "Accept: application/json" \
    -d "name"="et" \
    -d "path"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/{file}",
    "method": "PUT",
    "data": {
        "name": "et",
        "path": "et"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/files/{file}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `255`
    path | string |  optional  | Maximum: `255`

<!-- END_30d9bdafd8084f3ef40f4a7659a47cac -->

<!-- START_ecbffede2e1eeda15d12a6d2ae907e0c -->
## Bulk update to files.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/update" \
-H "Accept: application/json" \
    -d "attributes"="ex" \
    -d "id"="ex" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/update",
    "method": "POST",
    "data": {
        "attributes": "ex",
        "id": "ex"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_ecbffede2e1eeda15d12a6d2ae907e0c -->

<!-- START_038db4cc2cfde33c669b858174d81001 -->
## Delete file.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/files/{file}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/{file}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/files/{file}`


<!-- END_038db4cc2cfde33c669b858174d81001 -->

<!-- START_380b3de49c8bba6e956f264dd130e4e4 -->
## Bulk delete to files.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/delete" \
-H "Accept: application/json" \
    -d "id"="maiores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/delete",
    "method": "POST",
    "data": {
        "id": "maiores"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_380b3de49c8bba6e956f264dd130e4e4 -->

<!-- START_2aa19a54848a56338388308b1205d6ae -->
## Restore file.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/files/{file}" \
-H "Accept: application/json" \
    -d "path"="natus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/{file}",
    "method": "PATCH",
    "data": {
        "path": "natus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/files/{file}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    path | string |  optional  | 

<!-- END_2aa19a54848a56338388308b1205d6ae -->

<!-- START_80c91d1e1b1e4b8479bd6ddb302a9ad7 -->
## Bulk restore to files.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/restore" \
-H "Accept: application/json" \
    -d "id"="neque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/restore",
    "method": "POST",
    "data": {
        "id": "neque"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_80c91d1e1b1e4b8479bd6ddb302a9ad7 -->

<!-- START_199a07f49fc73bca009bbcca2d11d510 -->
## Search &amp; list user roles.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (roles with name like %-admin) OR (display_name like % Admin)
   - name : '%-admin' : like | or @ key : '% Admin' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/search" \
-H "Accept: application/json" \
    -d "options"="eos" \
    -d "options.id"="eos" \
    -d "options.columns"="eos" \
    -d "options.order"="eos" \
    -d "options.limit"="62883411" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="eos" \
    -d "options.scope"="eos" \
    -d "options.relationships"="eos" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/search",
    "method": "POST",
    "data": {
        "options": "eos",
        "options.id": "eos",
        "options.columns": "eos",
        "options.order": "eos",
        "options.limit": 62883411,
        "options.no-paginate": true,
        "options.condition": "eos",
        "options.scope": "eos",
        "options.relationships": "eos"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_199a07f49fc73bca009bbcca2d11d510 -->

<!-- START_ae70004c59e8ac570e4f4919d8558ebb -->
## Get files as option list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/list-options`


<!-- END_ae70004c59e8ac570e4f4919d8558ebb -->

<!-- START_d9fa7fac171f073cda51f116b743e52f -->
## Copy file to path.

Request parameters:
   - path: file new path
   - name (optional): file new name

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/copy/{file}" \
-H "Accept: application/json" \
    -d "name"="enim" \
    -d "path"="enim" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/copy/{file}",
    "method": "POST",
    "data": {
        "name": "enim",
        "path": "enim"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/copy/{file}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | Maximum: `255`
    path | string |  required  | Maximum: `255`

<!-- END_d9fa7fac171f073cda51f116b743e52f -->

<!-- START_51b9d951ecff2e4acf8d1ea2dfbafbdd -->
## Moves file to path.

*   Request parameters:
   - path: file new path
   - name (optional): file new name

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/files/move/{file}" \
-H "Accept: application/json" \
    -d "name"="iure" \
    -d "path"="iure" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/files/move/{file}",
    "method": "POST",
    "data": {
        "name": "iure",
        "path": "iure"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/files/move/{file}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | Maximum: `255`
    path | string |  required  | Maximum: `255`

<!-- END_51b9d951ecff2e4acf8d1ea2dfbafbdd -->

#Log: Logs
<!-- START_87497755227fd2473541a2acd4756d8e -->
## Get all logs.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/logs" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/logs",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/logs`


<!-- END_87497755227fd2473541a2acd4756d8e -->

<!-- START_3772f0218518f2689c565fed39009f7a -->
## Get a specific log.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/logs/{log}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/logs/{log}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/logs/{log}`


<!-- END_3772f0218518f2689c565fed39009f7a -->

<!-- START_29350e1bafd9e86eeb7d0d71616b4b7c -->
## Search &amp; list logs.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (logs with service like %-users) OR (action like % guide)
   - service : '%-users' : like | or @ action : '% guide' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/logs/search" \
-H "Accept: application/json" \
    -d "options"="et" \
    -d "options.id"="et" \
    -d "options.columns"="et" \
    -d "options.order"="et" \
    -d "options.limit"="476983" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="et" \
    -d "options.scope"="et" \
    -d "options.relationships"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/logs/search",
    "method": "POST",
    "data": {
        "options": "et",
        "options.id": "et",
        "options.columns": "et",
        "options.order": "et",
        "options.limit": 476983,
        "options.no-paginate": true,
        "options.condition": "et",
        "options.scope": "et",
        "options.relationships": "et"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/logs/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_29350e1bafd9e86eeb7d0d71616b4b7c -->

#Public
<!-- START_8a2debc2eb8ab69b366a5035c1f232c2 -->
## List all World Countries

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/public/countries" \
-H "Accept: application/json" \
    -d "format"="minima" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/public/countries",
    "method": "POST",
    "data": {
        "format": "minima"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/public/countries`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    format | string |  optional  | 

<!-- END_8a2debc2eb8ab69b366a5035c1f232c2 -->

<!-- START_4c7ae70403d6921c62e374cdaf2dec83 -->
## List all US States

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/public/states" \
-H "Accept: application/json" \
    -d "format"="est" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/public/states",
    "method": "POST",
    "data": {
        "format": "est"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/public/states`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    format | string |  optional  | 

<!-- END_4c7ae70403d6921c62e374cdaf2dec83 -->

#Sharepoint: Sharepoints
<!-- START_4a1f34e3a70aa0ba557ce695c82ae77b -->
## Get all sharepoints.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/sharepoints" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/sharepoints`


<!-- END_4a1f34e3a70aa0ba557ce695c82ae77b -->

<!-- START_fb0b9a34ecc63936aa2512719e3a7df2 -->
## Get a specific sharepoint.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/sharepoints/{sharepoint}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/{sharepoint}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/sharepoints/{sharepoint}`


<!-- END_fb0b9a34ecc63936aa2512719e3a7df2 -->

<!-- START_3f05ce03b7f37732703c5787e60abc15 -->
## Create sharepoint.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints" \
-H "Accept: application/json" \
    -d "file"="eligendi" \
    -d "virtual_path"="eligendi" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints",
    "method": "POST",
    "data": {
        "file": "eligendi",
        "virtual_path": "eligendi"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    file | file |  required  | Must be a file upload
    virtual_path | string |  required  | Maximum: `255`

<!-- END_3f05ce03b7f37732703c5787e60abc15 -->

<!-- START_e1da3c3dcaa3bf7dbc89b411a35d3073 -->
## Update sharepoint.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/sharepoints/{sharepoint}" \
-H "Accept: application/json" \
    -d "name"="culpa" \
    -d "virtual_path"="culpa" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/{sharepoint}",
    "method": "PUT",
    "data": {
        "name": "culpa",
        "virtual_path": "culpa"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/sharepoints/{sharepoint}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | Maximum: `255`
    virtual_path | string |  optional  | Maximum: `255`

<!-- END_e1da3c3dcaa3bf7dbc89b411a35d3073 -->

<!-- START_dac9ef5c1a658bc434bb94b07086868b -->
## Bulk update to sharepoints.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/update" \
-H "Accept: application/json" \
    -d "attributes"="et" \
    -d "id"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/update",
    "method": "POST",
    "data": {
        "attributes": "et",
        "id": "et"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_dac9ef5c1a658bc434bb94b07086868b -->

<!-- START_099d44535a2cccebb3bae7aea5ff890a -->
## Delete sharepoint.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/sharepoints/{sharepoint}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/{sharepoint}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/sharepoints/{sharepoint}`


<!-- END_099d44535a2cccebb3bae7aea5ff890a -->

<!-- START_9f5fa1cf2025105a274faf807cbab11a -->
## Bulk delete to sharepoints.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/delete" \
-H "Accept: application/json" \
    -d "id"="molestiae" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/delete",
    "method": "POST",
    "data": {
        "id": "molestiae"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_9f5fa1cf2025105a274faf807cbab11a -->

<!-- START_a61aec41ebcc755a209931e198fc20bc -->
## Restore sharepoint.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/sharepoints/{sharepoint}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/{sharepoint}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/sharepoints/{sharepoint}`


<!-- END_a61aec41ebcc755a209931e198fc20bc -->

<!-- START_99d02a26b075830020d687ebd6ff4cf1 -->
## Bulk restore to sharepoints.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/restore" \
-H "Accept: application/json" \
    -d "id"="dolores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/restore",
    "method": "POST",
    "data": {
        "id": "dolores"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_99d02a26b075830020d687ebd6ff4cf1 -->

<!-- START_026360d3670ddb4100e8094675a01db1 -->
## Search &amp; list sharepoints.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (sharepoints with virtual_path ending in /documents)
   - virtual_path : '%/documents' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/search" \
-H "Accept: application/json" \
    -d "options"="corporis" \
    -d "options.id"="corporis" \
    -d "options.columns"="corporis" \
    -d "options.order"="corporis" \
    -d "options.limit"="416" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="corporis" \
    -d "options.scope"="corporis" \
    -d "options.relationships"="corporis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/search",
    "method": "POST",
    "data": {
        "options": "corporis",
        "options.id": "corporis",
        "options.columns": "corporis",
        "options.order": "corporis",
        "options.limit": 416,
        "options.no-paginate": true,
        "options.condition": "corporis",
        "options.scope": "corporis",
        "options.relationships": "corporis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_026360d3670ddb4100e8094675a01db1 -->

<!-- START_baf4524184b8877b28da10f8e12d69a6 -->
## List sharepoints as option list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/list-options`


<!-- END_baf4524184b8877b28da10f8e12d69a6 -->

<!-- START_f5ae2db946e3461398e2491c9e5c4b57 -->
## Copy sharepoints to the specified virtual_path.

Request parameters:
  - virtual_path: sharepoint new virtual_path
  - name (optional): sharepoint new name

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/copy/{sharepoint}" \
-H "Accept: application/json" \
    -d "virtual_path"="ducimus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/copy/{sharepoint}",
    "method": "POST",
    "data": {
        "virtual_path": "ducimus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/copy/{sharepoint}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    virtual_path | string |  optional  | Maximum: `255`

<!-- END_f5ae2db946e3461398e2491c9e5c4b57 -->

<!-- START_71e452fd2904bca672fde2980e6026f9 -->
## Move sharepoints to the specified virtual_path.

Request parameters:
  - virtual_path: sharepoint new virtual_path
  - name (optional): sharepoint new name

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/move/{sharepoint}" \
-H "Accept: application/json" \
    -d "virtual_path"="magnam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/move/{sharepoint}",
    "method": "POST",
    "data": {
        "virtual_path": "magnam"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/move/{sharepoint}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    virtual_path | string |  optional  | Maximum: `255`

<!-- END_71e452fd2904bca672fde2980e6026f9 -->

<!-- START_1aa83a59ad1e57fb67f8a6b36a1ce638 -->
## Share file to user(s)

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/share/{sharepoint}" \
-H "Accept: application/json" \
    -d "users"="distinctio" \
    -d "permission"="w" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/share/{sharepoint}",
    "method": "POST",
    "data": {
        "users": "distinctio",
        "permission": "w"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/share/{sharepoint}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    users | array |  required  | Minimum: `1`
    permission | string |  required  | `r`, `w` or `o`

<!-- END_1aa83a59ad1e57fb67f8a6b36a1ce638 -->

<!-- START_36f16fd125f160eed443f8b4d2c97021 -->
## Unshare file

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/unshare/{sharepoint}" \
-H "Accept: application/json" \
    -d "users"="quo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/unshare/{sharepoint}",
    "method": "POST",
    "data": {
        "users": "quo"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/unshare/{sharepoint}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    users | array |  required  | 

<!-- END_36f16fd125f160eed443f8b4d2c97021 -->

<!-- START_eb03f36b8751df992147f704c7e332bf -->
## Get sharepoints by path.

It can flat or recursive (including subfolder files)

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/sharepoints/list-directory" \
-H "Accept: application/json" \
    -d "path"="atque" \
    -d "shared"="atque" \
    -d "recursive"="atque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/sharepoints/list-directory",
    "method": "POST",
    "data": {
        "path": "atque",
        "shared": "atque",
        "recursive": "atque"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/sharepoints/list-directory`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    path | string |  optional  | Maximum: `255`
    shared | string |  optional  | 
    recursive | string |  optional  | 

<!-- END_eb03f36b8751df992147f704c7e332bf -->

#User: Permissions
<!-- START_bd2777b2132db6c9cf93e928b5b5e44d -->
## Get all user permissions.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/permissions" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/permissions`


<!-- END_bd2777b2132db6c9cf93e928b5b5e44d -->

<!-- START_2cbf87c71ec8fd9634996f224a875400 -->
## Get a specific user permission.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/permissions/{permission}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/{permission}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/permissions/{permission}`


<!-- END_2cbf87c71ec8fd9634996f224a875400 -->

<!-- START_defb597dbd6eb21dee1f472ef6340873 -->
## Create user permission.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/permissions" \
-H "Accept: application/json" \
    -d "key"="illo" \
    -d "table_name"="illo" \
    -d "display_name"="illo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions",
    "method": "POST",
    "data": {
        "key": "illo",
        "table_name": "illo",
        "display_name": "illo"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/permissions`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    key | string |  required  | 
    table_name | string |  optional  | Allowed: alpha-numeric characters, as well as dashes and underscores.
    display_name | string |  required  | 

<!-- END_defb597dbd6eb21dee1f472ef6340873 -->

<!-- START_5a8d7aac5b31bb67ed4648a0005ce358 -->
## Update user permission.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/permissions/{permission}" \
-H "Accept: application/json" \
    -d "key"="sint" \
    -d "table_name"="sint" \
    -d "display_name"="sint" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/{permission}",
    "method": "PUT",
    "data": {
        "key": "sint",
        "table_name": "sint",
        "display_name": "sint"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/permissions/{permission}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    key | string |  optional  | 
    table_name | string |  optional  | Allowed: alpha-numeric characters, as well as dashes and underscores.
    display_name | string |  optional  | 

<!-- END_5a8d7aac5b31bb67ed4648a0005ce358 -->

<!-- START_a7458c04f662c80ba985cad70b184d0b -->
## Bulk update to user permissions

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/permissions/update" \
-H "Accept: application/json" \
    -d "attributes"="quo" \
    -d "id"="quo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/update",
    "method": "POST",
    "data": {
        "attributes": "quo",
        "id": "quo"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/permissions/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_a7458c04f662c80ba985cad70b184d0b -->

<!-- START_a76ff06df82f5e7b38639608624548fe -->
## Delete user permission.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/permissions/{permission}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/{permission}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/permissions/{permission}`


<!-- END_a76ff06df82f5e7b38639608624548fe -->

<!-- START_4af780ff000c85b4e5bd0dd4ac26d418 -->
## Bulk delete to user permissions.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/permissions/delete" \
-H "Accept: application/json" \
    -d "id"="esse" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/delete",
    "method": "POST",
    "data": {
        "id": "esse"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/permissions/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_4af780ff000c85b4e5bd0dd4ac26d418 -->

<!-- START_0f0370cac3ef6a7a1d0a74bcc3da0268 -->
## Restore user permission.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/permissions/{permission}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/{permission}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/permissions/{permission}`


<!-- END_0f0370cac3ef6a7a1d0a74bcc3da0268 -->

<!-- START_7d35b4582187aff6a50f9b5d4faac827 -->
## Bulk restore to user permissions.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/permissions/restore" \
-H "Accept: application/json" \
    -d "id"="vero" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/restore",
    "method": "POST",
    "data": {
        "id": "vero"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/permissions/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_7d35b4582187aff6a50f9b5d4faac827 -->

<!-- START_9105af900383c402fb4b9b2a73d1ad07 -->
## Search &amp; list user permissions.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => and @, or @

   **Condition example**: Search for (permissions with table_name == 'users') OR (key like %-users%)
   - table_name : users | or @ key : -users : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/permissions/search" \
-H "Accept: application/json" \
    -d "options"="dolores" \
    -d "options.id"="dolores" \
    -d "options.columns"="dolores" \
    -d "options.order"="dolores" \
    -d "options.limit"="61" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="dolores" \
    -d "options.scope"="dolores" \
    -d "options.relationships"="dolores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/search",
    "method": "POST",
    "data": {
        "options": "dolores",
        "options.id": "dolores",
        "options.columns": "dolores",
        "options.order": "dolores",
        "options.limit": 61,
        "options.no-paginate": true,
        "options.condition": "dolores",
        "options.scope": "dolores",
        "options.relationships": "dolores"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/permissions/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_9105af900383c402fb4b9b2a73d1ad07 -->

<!-- START_3a230009e3f91472a0a122d9cf37c74c -->
## Get user permissions as options list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/permissions/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/permissions/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/permissions/list-options`


<!-- END_3a230009e3f91472a0a122d9cf37c74c -->

#User: Roles
<!-- START_d2f16357cb4ed36dbb0e9529ea4a460c -->
## Get all user roles.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/roles" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/roles`


<!-- END_d2f16357cb4ed36dbb0e9529ea4a460c -->

<!-- START_ba05db58d706b9f94944b1ab79e1e4a2 -->
## Get a specific user role.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/{role}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/roles/{role}`


<!-- END_ba05db58d706b9f94944b1ab79e1e4a2 -->

<!-- START_5f753b2bffb6b34b6136ddfe1be7bcce -->
## Create user role.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/roles" \
-H "Accept: application/json" \
    -d "name"="quae" \
    -d "display_name"="quae" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles",
    "method": "POST",
    "data": {
        "name": "quae",
        "display_name": "quae"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    display_name | string |  required  | 

<!-- END_5f753b2bffb6b34b6136ddfe1be7bcce -->

<!-- START_86b4234ea126dc551cd3d6cafb582e80 -->
## Update user role.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/roles/{role}" \
-H "Accept: application/json" \
    -d "name"="officia" \
    -d "display_name"="officia" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/{role}",
    "method": "PUT",
    "data": {
        "name": "officia",
        "display_name": "officia"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/roles/{role}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | 
    display_name | string |  optional  | 

<!-- END_86b4234ea126dc551cd3d6cafb582e80 -->

<!-- START_a63b02296fafc0bc499e0fff1e2e9806 -->
## Bulk update to user roles

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/roles/update" \
-H "Accept: application/json" \
    -d "attributes"="quam" \
    -d "id"="quam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/update",
    "method": "POST",
    "data": {
        "attributes": "quam",
        "id": "quam"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_a63b02296fafc0bc499e0fff1e2e9806 -->

<!-- START_04c524fc2f0ea8c793406426144b4c71 -->
## Delete user role.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/{role}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/roles/{role}`


<!-- END_04c524fc2f0ea8c793406426144b4c71 -->

<!-- START_153c777c90ae5bce1f8bf1afbef220d5 -->
## Bulk delete to user roles.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/roles/delete" \
-H "Accept: application/json" \
    -d "id"="voluptatum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/delete",
    "method": "POST",
    "data": {
        "id": "voluptatum"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_153c777c90ae5bce1f8bf1afbef220d5 -->

<!-- START_5071b07212ad87a4f99835b2238b8cc0 -->
## Restore user role.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/roles/{role}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/{role}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/roles/{role}`


<!-- END_5071b07212ad87a4f99835b2238b8cc0 -->

<!-- START_cc6c64ea628ccda85ab806e124efe96b -->
## Bulk restore to user roles.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/roles/restore" \
-H "Accept: application/json" \
    -d "id"="tenetur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/restore",
    "method": "POST",
    "data": {
        "id": "tenetur"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_cc6c64ea628ccda85ab806e124efe96b -->

<!-- START_4a233d33e4ae13ebb9962a67a123f37b -->
## Search &amp; list user roles.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => @and, @or

   **Condition example**: Search for (roles with name like %-admin) OR (display_name like % Admin)
   - name : '%-admin' : like | or @ key : '% Admin' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/roles/search" \
-H "Accept: application/json" \
    -d "options"="cupiditate" \
    -d "options.id"="cupiditate" \
    -d "options.columns"="cupiditate" \
    -d "options.order"="cupiditate" \
    -d "options.limit"="70977" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="cupiditate" \
    -d "options.scope"="cupiditate" \
    -d "options.relationships"="cupiditate" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/search",
    "method": "POST",
    "data": {
        "options": "cupiditate",
        "options.id": "cupiditate",
        "options.columns": "cupiditate",
        "options.order": "cupiditate",
        "options.limit": 70977,
        "options.no-paginate": true,
        "options.condition": "cupiditate",
        "options.scope": "cupiditate",
        "options.relationships": "cupiditate"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_4a233d33e4ae13ebb9962a67a123f37b -->

<!-- START_6b9e0d6e2790cc0ab2835d0021fb16ac -->
## Get user roles as option list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/roles/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/roles/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/roles/list-options`


<!-- END_6b9e0d6e2790cc0ab2835d0021fb16ac -->

#User: Users
<!-- START_1aff981da377ba9a1bbc56ff8efaec0d -->
## Get all users.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/users`


<!-- END_1aff981da377ba9a1bbc56ff8efaec0d -->

<!-- START_cedc85e856362e0e3b46f5dcd9f8f5d0 -->
## Get a specific user.

> Example request:

```bash
curl -X GET "http://localhost:8888/api/v1/users/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/{user}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/users/{user}`


<!-- END_cedc85e856362e0e3b46f5dcd9f8f5d0 -->

<!-- START_4194ceb9a20b7f80b61d14d44df366b4 -->
## Create user (deprecated).

See: RegisterController::register()

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users`


<!-- END_4194ceb9a20b7f80b61d14d44df366b4 -->

<!-- START_824a2630a132ea37db74caa4e230a83c -->
## Update user.

> Example request:

```bash
curl -X PUT "http://localhost:8888/api/v1/users/{user}" \
-H "Accept: application/json" \
    -d "email"="gleason.ceasar@example.org" \
    -d "password"="sunt" \
    -d "first_name"="sunt" \
    -d "last_name"="sunt" \
    -d "avatar"="http://www.gleason.com/" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/{user}",
    "method": "PUT",
    "data": {
        "email": "gleason.ceasar@example.org",
        "password": "sunt",
        "first_name": "sunt",
        "last_name": "sunt",
        "avatar": "http:\/\/www.gleason.com\/"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/users/{user}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  optional  | 
    password | string |  optional  | Minimum: `6`
    first_name | string |  optional  | Maximum: `255`
    last_name | string |  optional  | Maximum: `255`
    avatar | url |  optional  | 

<!-- END_824a2630a132ea37db74caa4e230a83c -->

<!-- START_015cee111f523663898fb5ef3fb8ba3d -->
## Bulk update to users.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/users/update" \
-H "Accept: application/json" \
    -d "attributes"="repellendus" \
    -d "id"="repellendus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/update",
    "method": "POST",
    "data": {
        "attributes": "repellendus",
        "id": "repellendus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    attributes | array |  required  | 
    id | string |  required  | 

<!-- END_015cee111f523663898fb5ef3fb8ba3d -->

<!-- START_22354fc95c42d81a744eece68f5b9b9a -->
## Delete user.

> Example request:

```bash
curl -X DELETE "http://localhost:8888/api/v1/users/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/{user}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/users/{user}`


<!-- END_22354fc95c42d81a744eece68f5b9b9a -->

<!-- START_816b28a22d87c6c7781f16fa43ad48bd -->
## Bulk delete to users.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/users/delete" \
-H "Accept: application/json" \
    -d "id"="aliquid" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/delete",
    "method": "POST",
    "data": {
        "id": "aliquid"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users/delete`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_816b28a22d87c6c7781f16fa43ad48bd -->

<!-- START_546f5b6ecf5c237e0f19f109bb166ad9 -->
## Restore user.

> Example request:

```bash
curl -X PATCH "http://localhost:8888/api/v1/users/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/{user}",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/v1/users/{user}`


<!-- END_546f5b6ecf5c237e0f19f109bb166ad9 -->

<!-- START_4d31c7ca9e3ea3bd48b6110b6d3a98f1 -->
## Bulk restore to users.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/users/restore" \
-H "Accept: application/json" \
    -d "id"="aspernatur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/restore",
    "method": "POST",
    "data": {
        "id": "aspernatur"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users/restore`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | 

<!-- END_4d31c7ca9e3ea3bd48b6110b6d3a98f1 -->

<!-- START_89e22ac0c94b3f953efa67025446e89e -->
## Search &amp; list users.

**Parameter $request['options']:**
 - id                   => id or array of ids to retrieve
 - columns [array]      => columns to return
 - order [string|array] => specify order with string like 'criteria:direction'
 - limit [int]          => specify page items limit
 - no-paginate [bool]   => specify to not paginate results
 - scope [string]       => specify item status: deleted, active, all (active + deleted)
 - conditions [array]   => searching conditions (see explanation)

   **Conditions syntax** =>  join @ condition ... | condition
   - Single Condition syntax  => column : value : operator
     - column (required)      => column to search
     - value (required)       => value to compare
     - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
   - Join operator (optional) => and @, or @

   **Condition example**: Search for (users with first_name =John) AND (email like %gmail.com)
     first_name : 'John' | or @ email : '%gmail.com' : like

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/users/search" \
-H "Accept: application/json" \
    -d "options"="corporis" \
    -d "options.id"="corporis" \
    -d "options.columns"="corporis" \
    -d "options.order"="corporis" \
    -d "options.limit"="807" \
    -d "options.no-paginate"="1" \
    -d "options.condition"="corporis" \
    -d "options.scope"="corporis" \
    -d "options.relationships"="corporis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/search",
    "method": "POST",
    "data": {
        "options": "corporis",
        "options.id": "corporis",
        "options.columns": "corporis",
        "options.order": "corporis",
        "options.limit": 807,
        "options.no-paginate": true,
        "options.condition": "corporis",
        "options.scope": "corporis",
        "options.relationships": "corporis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    options | array |  optional  | 
    options.id | string |  optional  | 
    options.columns | array |  optional  | 
    options.order | string |  optional  | 
    options.limit | numeric |  optional  | 
    options.no-paginate | boolean |  optional  | 
    options.condition | array |  optional  | 
    options.scope | string |  optional  | 
    options.relationships | array |  optional  | 

<!-- END_89e22ac0c94b3f953efa67025446e89e -->

<!-- START_a71b1311e33199a91eaf92cd90dde4e6 -->
## Get users as options list.

> Example request:

```bash
curl -X POST "http://localhost:8888/api/v1/users/list-options" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8888/api/v1/users/list-options",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/users/list-options`


<!-- END_a71b1311e33199a91eaf92cd90dde4e6 -->

