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
  createUser(ajoutUser: AjoutUser, imageFile): Observable<AjoutUser> {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + localStorage.getItem('token'));
    const formData: FormData = new FormData();
    formData.append('nom', ajoutUser.nom);
    formData.append('prenom', ajoutUser.prenom);
    formData.append('username', ajoutUser.username);
    formData.append('password', ajoutUser.password);
    formData.append('teluser', ajoutUser.teluser);
    formData.append('status', ajoutUser.status);
    formData.append('imageName', imageFile, imageFile.name);
    return this.http.post<AjoutUser>(this.url + '/api/inscris', formData,{headers : headers});
  }
}
