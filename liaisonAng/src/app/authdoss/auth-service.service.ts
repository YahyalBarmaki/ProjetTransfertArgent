import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthServiceService {
  postUrl: 'http::localhost:4200';
  constructor(private http: HttpClient) { }
  login(data) {
    return this.http.post<any>(this.postUrl + 'api/login', data, { observe: 'response' });
  }
  saveToken(jwt: string) {
    localStorage.setItem('token', jwt);
  }
}
