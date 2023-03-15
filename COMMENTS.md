# Comments

- Julius Caesar is part of the 'director' department, but that department isn't actually mentioned in the database spec. There _is_ a headquarters at the Charles Darwin building, but I'm unsure if this is the same thing? I've put him down as hq.
- I'm unsure about the /endpoint?cn=not_found. The spec seems to imply that the reader would send that, but personally I think I'd program the reader system to catch read errors/not founds itself. Only submit successful reads to the API. If the ID isn't in the db, then you can return a not found/empty result.
- Regarding calling the API, I think there should be some sort of security that ensures the API only responds to requests from the RFID readers. Otherwise crafty people could go to that url in their browser, and since it returns employee data, it might even be a data security issue.
- Could the department id they're signing into be sent with the rfid lookup? That way you could drop the list of departments in the response and simply check they're ok for access on the api.

If I had more time I'd:

- Create a route such as /auth/ and mount our authentication-related endpoints under that.
- vars.env isn't the securest way of passing secrets, so would probably move it to a docker secrets or something.
- Make a separate mysqli wrapper with logging and error handling. I'd also figure out how to inject it as a dependency into Slim.
- Add testing for the endpoints and even unit testing for individual classes and methods.
