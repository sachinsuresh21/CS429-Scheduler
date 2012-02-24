//
//  SchedulerMasterViewController.h
//  Scheduler-iOS
//
//  Created by NiaN Chen on 2/24/12.
//  Copyright (c) 2012 CN3 Inc. All rights reserved.
//

#import <UIKit/UIKit.h>

@class SchedulerDetailViewController;

@interface SchedulerMasterViewController : UITableViewController

@property (strong, nonatomic) SchedulerDetailViewController *detailViewController;

@end
