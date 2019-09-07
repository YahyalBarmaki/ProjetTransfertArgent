import { TestBed } from '@angular/core/testing';

import { PartServiceService } from './part-service.service';

describe('PartServiceService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: PartServiceService = TestBed.get(PartServiceService);
    expect(service).toBeTruthy();
  });
});
