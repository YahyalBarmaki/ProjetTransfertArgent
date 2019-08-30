import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';  
import { HttpHeaders } from '@angular/common/http';  
import { Observable } from 'rxjs';
import { User } from './modele/user';
@Injectable({
  providedIn: 'root'
})
export class UerSerService {
  url = 'http://localhost:8000';
  constructor(private http: HttpClient) { }
  getAllUsers(): Observable<User[]> {
    return this.http.get<User[]>
      (this.url + '/api/inscris');
  }
  ajoutUser(user: User): Observable<User> {
    const httpOptions = { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) };
    return this.http.post<User> (this.url + '/api/inscris', user, httpOptions);
  }
}
