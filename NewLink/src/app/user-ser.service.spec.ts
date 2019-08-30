import { TestBed } from '@angular/core/testing';

import { UerSerService } from './user-ser.service';

describe('UerSerService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: UerSerService = TestBed.get(UerSerService);
    expect(service).toBeTruthy();
  });
});
