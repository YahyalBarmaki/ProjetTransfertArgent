import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AjoutUser } from './modele/ajout-user';
@Injectable({
  providedIn: 'root'
})
export class AjoutUserService {
  url = 'http://localhost:8000';

  constructor(private http: HttpClient) { }
  getAllUser(): Observable<AjoutUser[]> {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + localStorage.getItem('token'));
    // tslint:disable-next-line: align
    return this.http.get<AjoutUser[]>(this.url + '/api/listeU', {headers : headers});
  }
  createUser(ajoutUser: AjoutUser): Observable<AjoutUser> {
    const httpOptions = { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) };
    return this.http.post<AjoutUser>(this.url + '/api/inscris', ajoutUser, httpOptions);
  }
}
