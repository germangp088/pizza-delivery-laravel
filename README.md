# pizza-delivery-laravel
Back-end service built on laravel for pizza-delivery project.

### Gitflow
Tasks where posted on [Trello](https://trello.com/b/tI2dQlTA/pizza-delivery-laravel) kanban, you can follow [Github](https://github.com/germangp088/pizza-delivery-laravel) closed branches you can inspect gitflow to know how development lifecycle where going.

### Installation

```sh
$ npm install
```
```sh
$ composer install
```

### Run

```sh
$ npm run start
```

### Tests
```sh
$ npm run test
```

###### ENDPOINTS

-- GET /{URL}/product

-- GET /{URL}/shipping_fee

-- GET /{URL}/currency

-- POST /{URL}/order

-- GET /{URL}/order/history/{ip}

**Transaction Body Example**
```json
{
	"products": [
		{
			"id_product": 1,
			"price": 4.25,
			"quantity": 2
		},
		{
			"id_product": 2,
			"price": 5.99,
			"quantity": 3
		}
	],
	"bill": {
		"id_currency": 1,
		"subtotal": 26.47,
		"shipping_fee": 1.99
	},
	"customer":{
		"name": "",
		"email": "",
		"contact_number": "",
		"delivery_address": "",
		"ip": ""
	}
}
```
