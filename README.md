
# Un1q Calendar




## Run Locally

Clone the project

```bash
  git clone https://github.com/NicolasH0/un1q-calendar
```

Go to the project directory

```bash
  cd uniq-calendar
```

Install dependencies

```bash
  composer install
```
Copy .env

```bash
  Copy .env.example and paste it in .env
```

Install DB

```bash
  php artisan migrate
```

Start the server

```bash
  php artisan serve
```


## API Reference

#### Create event

```http
  POST /create
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. |
| `start_time` | `datetime` | **Required**. |
| `end_time` | `datetime` | **Required**. |
| `recurrence` | `string` | **Required**. |
| `repeat_until` | `int` | **Required**. |
| `description` | `string` |  |

#### Update event

```http
  PATCH /update
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. |
| `start_time` | `datetime` | **Required**. |
| `end_time` | `datetime` | **Required**. |
| `recurrence` | `string` | **Required**. |
| `repeat_until` | `int` | **Required**. |
| `description` | `string` |  |

#### Get events

```http
  GET /event?start_time=2023-08-24 13:18:53&end_time=2023-08-24 14:18:53
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `start_time`      | `datetime` | **Required**. |
| `end_time`      | `datetime` | **Required**.|


#### Delete event

```http
  DELETE /delete/1
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. |

## Must know

- Soft delete is on
- Domains design pattern
- PHP 7.4.33
- Create and Update are under an Observer for recurring events
## Optimizations

- Use request validator
- Create functional testing for api calls
