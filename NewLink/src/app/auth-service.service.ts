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
    return this.httpClient.post<any>(this.hostUrl + '/api/login', data);
  }
  isSuperAdmin() {
    return this.roles.indexOf('ROLE_SUPER_ADMIN') >= 0;
  }
  isPartenaire() {
    return this.roles.indexOf('ROLE_PARTENAIRE') >= 0;
  }
  isCassier() {
    return this.roles.indexOf(' ROLE_CASSIER') >= 0;
  }
  isAuthentifier() {
    return this.roles && (this.isSuperAdmin() || this.isPartenaire || this.isCassier);
  }
}
