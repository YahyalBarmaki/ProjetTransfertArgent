import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class AuthServiceService {
  hostUrl = 'http://localhost:8000';
  jwt: string;
  usename: string;
  roles: Array<string>;
  constructor(private httpClient: HttpClient) { }
  login(data) {
    return this.httpClient.post<any>(this.hostUrl + '/api/login', data, { observe: 'response' });
  }
  saveToken(jwt: string) {
    localStorage.setItem('token', jwt);
  }
}
