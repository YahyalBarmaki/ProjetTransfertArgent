import { Component, OnInit } from '@angular/core';
import { AjoutUserService } from '../ajout-user.service';
import { AjoutUser } from '../modele/ajout-user';

@Component({
  selector: 'app-list-user',
  templateUrl: './list-user.component.html',
  styleUrls: ['./list-user.component.scss']
})
export class ListUserComponent implements OnInit {

  constructor(private allUser: AjoutUserService) { }
  users: AjoutUser[];
  ngOnInit() {
    this.allUser.getAllUser()
    .subscribe(
    resp => {
      console.log(resp);
      this.users = resp;
      console.log(this.users);
    },
    error => {
      console.log(error);
    }
  );
  }

}
