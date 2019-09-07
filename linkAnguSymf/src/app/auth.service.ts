import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class AuthenticationService {
    jwt: string;
    username: string;
    roles: Array<string>;
    host2 = 'http://localhost:8000';
    constructor(private http: HttpClient) {}
    login(data)
    {
        return this.http.post(this.host2 + 'api/login', data, { observe: 'response' });
    }

}
