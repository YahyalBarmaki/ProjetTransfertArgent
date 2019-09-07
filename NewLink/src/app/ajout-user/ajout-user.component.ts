import { Component, OnInit } from '@angular/core';
import { AjoutUser } from '../modele/ajout-user';
import { AjoutUserService } from '../ajout-user.service';

@Component({
  selector: 'app-ajout-user',
  templateUrl: './ajout-user.component.html',
  styleUrls: ['./ajout-user.component.scss']
})
export class AjoutUserComponent implements OnInit {
 // addUser = new AjoutUser();
  erreurMsg = '';
  imageFile : File =null 
  imageUrl = '/assets/img/apreEX.png';
  constructor(private ajoutSer: AjoutUserService, private authser: AjoutUserService, ) { }

  ngOnInit() {
  }
  handleFileInput(file: FileList) {
    this.imageFile = file.item(0);
    const reader =  new  FileReader();
    reader.onload = (event: any) => {
      this.imageUrl = event.target.result;
    // tslint:disable-next-line: semicolonstatusTestatusTextstatusTextxt
    };

    reader.readAsDataURL(this.imageFile);
  }
  onSubmit(data) {
    this.ajoutSer.createUser(data,this.imageFile)
    .subscribe(
      data => console.log('Succees!', data),
      error => this.erreurMsg = error.statusText
    );
  }

}
