import { Component, OnInit, ViewChild } from '@angular/core';
import { AjoutUserService } from '../ajout-user.service';
import { AjoutUser } from '../modele/ajout-user';
import {MatPaginator} from '@angular/material/paginator';
import {MatSort} from '@angular/material/sort';
import {MatTableDataSource} from '@angular/material/table';

@Component({
  selector: 'app-list-user',
  templateUrl: './list-user.component.html',
  styleUrls: ['./list-user.component.scss']
})
export class ListUserComponent implements OnInit {
  displayedColumns: string[] = ['id', 'username', 'role', 'nom', 'prenom', 'teluser'];
  dataSource: MatTableDataSource<AjoutUser>;
  afficher = false;
  @ViewChild(MatPaginator, { static: true }) paginator: MatPaginator;
  @ViewChild(MatSort, { static: true }) sort: MatSort;

  users: AjoutUser[];

  constructor(private allUser: AjoutUserService) {
  }

  ngOnInit() {
    this.allUser.getAllUser()
      .subscribe(
        resp => {
            this.users = resp;
            this.afficher = true;
            this.dataSource = new MatTableDataSource(this.users);
            this.dataSource.paginator = this.paginator;
            this.dataSource.sort = this.sort;
            console.log(resp);
            console.log(this.users);
        },
        error => {
          console.log(error);
        }
      );
  }
  applyFilter(filterValue: string) {
    this.dataSource.filter = filterValue.trim().toLowerCase();
    console.log(this.dataSource);
    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
    // tslint:disable-next-line: eofline
  }
}
