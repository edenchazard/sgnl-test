/auth/fetch?cn=142594708f3a5a3ac2980914a0fc954f

```json
{
  "full_name": "Julius Caesar",
  "department": ["hq", "development"]
}
```

/auth/fetch?cn=not_found

```json
{
  "full_name": "",
  "department": []
}
```

/auth/fetch?cn=abcd94708f3a5a3ac2980914a0fabcde

```json
{
  "full_name": "",
  "department": []
}
```

/auth/fetch?foo=bar

```
404 response.
```

/auth/fetch?cn=test_123-invalidChars

```
500 response.
```
