export class AjoutUser {
  id: number;
  username: string;
  role: any;
  password: string;
  nom: string;
  prenom: string;
  teluser: string;
  status: any;
  // tslint:disable-next-line: variable-name
  image_name: string;
  imageFile: File;

  constructor(
  id: number = null,
  username: string = null,
  role: any = null,
  password: string = null,
  nom: string = null,
  prenom: string = null,
  teluser: string = null,
  status: any = null,
  // tslint:disable-next-line: variable-name
  imageFile: File= null,
  ) {}
}
